@extends('layouts.app')

@section('content')
<div class="flex justify-between mb-4">
    <h2 class="text-2xl font-bold">Data Lowongan Magang</h2>
    <div class="space-x-2">
        <a href="{{ route('admin.create') }}" class="px-4 py-2 rounded bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
            + Tambah Lowongan
        </a>
    </div>
</div>

<table class="w-full bg-white rounded shadow">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 text-start">Departemen</th>
            <th class="p-3 text-start">Posisi</th>
            <th class="p-3 text-start">Kuota</th>
            <th class="p-3 text-start">Deskripsi</th>
            <th class="p-3 text-start">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lowongans as $lowongan)
        <tr class="border-t">
            <td class="p-3">{{ $lowongan->departemen->name }}</td>
            <td class="p-3">{{ $lowongan->posisi }}</td>
            <td class="p-3">{{ $lowongan->quota }}</td>
            <td class="p-3">{{ $lowongan->deskripsi }}</td>
            <td class="p-3 flex gap-2">
                <a href="{{ route('admin.edit', $lowongan->id) }}" class="bg-yellow-500 text-white hover:bg-yellow-600 px-3 py-1 rounded">Edit</a>

                <form method="POST" action="{{ route('admin.destroy', $lowongan->id) }}">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus data?')" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection