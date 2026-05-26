<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departemen;
use App\Models\Lowongan;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $lowongans = Lowongan::with('departemen')->oldest()->get(); 
        return view('admin.index', compact('lowongans'));
    }

    public function create(){
        $departemens = Departemen::all(); 
        return view('admin.create', compact('departemens')); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dept_id' => 'required|exists:departemens,id',
            'posisi' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
        ]);

        Lowongan::create($validated);

        return redirect()->route('admin.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $departemens = Departemen::all();

        return view('admin.edit', compact('lowongan', 'departemens'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'dept_id' => 'required|exists:departemens,id',
            'posisi' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
        ]);

        $lowongan = Lowongan::findOrFail($id);
        $lowongan->update($validated);

        return redirect()->route('admin.index')->with('success', 'Lowongan berhasil diupdate.');
    }

    public function destroy(int $id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->delete();

        return redirect()->route('admin.index')->with('success', 'Lowongan berhasil dihapus.');
    }

    public function pendaftar()
    {
        $pendaftars = Pendaftar::with('lowongan.departemen')->latest()->get();
        return view('admin.pendaftar', compact('pendaftars'));
    }

    public function approve(int $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->update(['status' => 'A']);

        return redirect()->route('admin.pendaftar')->with('success', 'Pendaftar disetujui.');
    }

    public function reject(int $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->update(['status' => 'R']);

        return redirect()->route('admin.pendaftar')->with('success', 'Pendaftar ditolak.');
    }

    public function reports()
    {
        $totalPendaftar = Pendaftar::count();
        $totalPending = Pendaftar::where('status', 'P')->count();
        $totalApproved = Pendaftar::where('status', 'A')->count();
        $totalRejected = Pendaftar::where('status', 'R')->count();
        $kuotaPerDepartemen = Lowongan::query()
            ->select('dept_id', DB::raw('SUM(quota) as total_quota'))
            ->groupBy('dept_id');
        $summaryDepartemen = Departemen::query()
            ->leftJoinSub($kuotaPerDepartemen, 'kuota_per_departemen', function ($join) {
                $join->on('departemens.id', '=', 'kuota_per_departemen.dept_id');
            })
            ->leftJoin('lowongans', 'departemens.id', '=', 'lowongans.dept_id')
            ->leftJoin('pendaftars', 'lowongans.id', '=', 'pendaftars.id_lowongan')
            ->select(
                'departemens.name as departemen',
                DB::raw('COALESCE(kuota_per_departemen.total_quota, 0) as total_quota'),
                DB::raw("SUM(CASE WHEN pendaftars.status = 'P' THEN 1 ELSE 0 END) as pending"),
                DB::raw("SUM(CASE WHEN pendaftars.status = 'A' THEN 1 ELSE 0 END) as diterima"),
                DB::raw("SUM(CASE WHEN pendaftars.status = 'R' THEN 1 ELSE 0 END) as ditolak")
            )
            ->groupBy('departemens.id', 'departemens.name', 'kuota_per_departemen.total_quota')
            ->orderBy('departemens.name')
            ->get()
            ->map(function ($row) {
                $row->sisa_quota = max(0, $row->total_quota - $row->diterima);
                return $row;
            });

        return view('admin.reports', compact(
            'totalPendaftar',
            'totalPending',
            'totalApproved',
            'totalRejected',
            'summaryDepartemen'
        ));
    }
}
