@extends('layouts.app')

@section('content')
<div class="flex justify-between mb-4">
    <h2 class="text-2xl font-bold">Daftar Lowongan Magang</h2>
    <div class="space-x-2">
        
    </div>
</div>


<div class="overflow-x-auto">
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-3 text-start">Posisi</th>
                <th class="p-3 text-start">Departemen</th>
                <th class="p-3 text-start">Deskripsi</th>
                <th class="p-3 text-start">Kuota</th>
                <th class="p-3 text-start">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lowongans as $lowongan)
            <tr class="border-t">
                <td class="p-3 font-semibold">{{ $lowongan->posisi }}</td>
                <td class="p-3">{{ $lowongan->departemen->name }}</td>
                <td class="p-3">{{ $lowongan->deskripsi }}</td>
                <td class="p-3">{{ $lowongan->quota }}</td>
                <td class="p-3">
                    <a href="{{ route('user.daftar', $lowongan->id) }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                        Daftar
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-3 text-center text-gray-500">
                    Belum ada lowongan magang.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
