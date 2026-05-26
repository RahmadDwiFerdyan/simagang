@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="max-w-3xl bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Form Pendaftaran Magang</h2>
    
        <div class="mb-4 p-3 bg-gray-100 rounded">
            <p><b>Posisi:</b> {{ $lowongan->posisi }}</p>
            <p><b>Departemen:</b> {{ $lowongan->departemen->name }}</p>
            <p><b>Deskripsi:</b> {{ $lowongan->deskripsi }}</p>
        </div>
    
        <form method="POST" action="{{ route('user.daftar.store') }}">
            @csrf
    
            <input type="hidden" name="id_lowongan" value="{{ $lowongan->id }}">
    
            <label>Nama</label>
            <input name="name" class="w-full border p-2 rounded mb-3">
    
            <label>Gender</label>
            <select name="gender" class="w-full border p-2 rounded mb-3">
                <option value="Male">Laki-laki</option>
                <option value="Female">Perempuan</option>
            </select>
    
            <label>Tanggal Lahir</label>
            <input type="date" name="dob" class="w-full border p-2 rounded mb-3">
    
            <label>Alamat</label>
            <textarea name="address" class="w-full border p-2 rounded mb-3"></textarea>
    
            <label>No Telepon</label>
            <input name="no_telp" class="w-full border p-2 rounded mb-3">
    
            <label>Universitas</label>
            <input name="university" class="w-full border p-2 rounded mb-3">
    
            <label>Jurusan</label>
            <input name="major" class="w-full border p-2 rounded mb-3">
    
            <label>IPK</label>
            <input type="number" step="0.01" name="ipk" class="w-full border p-2 rounded mb-3">
    
            <label>Link CV</label>
            <input name="path_cv" class="w-full border p-2 rounded mb-3">
    
            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                Kirim Pendaftaran
            </button>
        </form>
    </div>
</div>
@endsection
