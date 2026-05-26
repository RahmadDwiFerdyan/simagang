<?php

namespace App\Http\Controllers;


use App\Models\Lowongan;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::with('departemen')->oldest()->get();
        return view('user.index', compact('lowongans'));
    }

    public function showDaftarForm(int $id)
    {
        $lowongan = Lowongan::with('departemen')->findOrFail($id);
        return view('user.daftar', compact('lowongan'));
    }

    public function storePendaftar(Request $request)
    {
        $validated = $request->validate([
            'id_lowongan' => 'required|exists:lowongans,id',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'dob' => 'required|date',
            'address' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'university' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'ipk' => 'required|numeric|min:0|max:4',
            'path_cv' => 'required|url',
            'status' => 'P',
        ]);

        Pendaftar::create($validated);

        return redirect()->route('user.index')->with('success', 'Pendaftaran berhasil dikirim.');
    }

  
}
