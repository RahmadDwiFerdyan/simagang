@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Riwayat Pendaftaran Magang</h2>

<table class="w-full bg-white rounded shadow">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 text-start">Posisi</th>
            <th class="p-3 text-start">Departemen</th>
            <th class="p-3 text-start">Tanggal Daftar</th>
            <th class="p-3 text-start">Status</th>
            <th class="p-3 text-start">CV</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pendaftars as $pendaftar)
        <tr class="border-t">
            <td class="p-3">{{ $pendaftar->lowongan->posisi }}</td>
            <td class="p-3">{{ $pendaftar->lowongan->departemen->name }}</td>
            <td class="p-3">{{ $pendaftar->created_at->format('d M Y') }}</td>
            <td class="p-3">
                @if($pendaftar->status == 'P')
                    <span class="bg-yellow-200 px-2 py-1 rounded">Pending</span>
                @elseif($pendaftar->status == 'A')
                    <span class="bg-green-200 px-2 py-1 rounded">Approved</span>
                @else
                    <span class="bg-red-200 px-2 py-1 rounded">Rejected</span>
                @endif
            </td>
            <td class="p-3">
                <a href="{{ $pendaftar->path_cv }}" target="_blank" class="text-indigo-600 underline">
                    Lihat CV
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="p-3 text-center text-gray-500">
                Belum ada riwayat pendaftaran.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
