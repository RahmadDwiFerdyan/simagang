@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="max-w-xl bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Edit Lowongan</h2>
    
        <form method="POST" action="{{ route('admin.update', $lowongan->id) }}">
            @csrf
            @method('PUT')
    
            <label>Departemen</label>
            <select name="dept_id" class="w-full border p-2 rounded mb-3">
                @foreach($departemens as $departemen)
                    <option value="{{ $departemen->id }}" @selected($lowongan->dept_id == $departemen->id)>
                        {{ $departemen->name }}
                    </option>
                @endforeach
            </select>
    
            <label>Posisi</label>
            <input name="posisi" value="{{ $lowongan->posisi }}" class="w-full border p-2 rounded mb-3">
    
            <label>Kuota</label>
            <input type="number" name="quota" value="{{ $lowongan->quota }}" class="w-full border p-2 rounded mb-3">
    
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="w-full border p-2 rounded mb-3">{{ $lowongan->deskripsi }}</textarea>
    
            <button class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</div>
@endsection
