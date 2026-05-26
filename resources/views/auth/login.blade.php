@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Login</h2>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.process') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded mb-3">

        <label>Password</label>
        <input type="password" name="password" class="w-full border p-2 rounded mb-3">

        <button class="bg-indigo-600 text-white px-4 py-2 rounded">
            Login
        </button>
    </form>

    <p class="text-sm mt-4 text-gray-400">
        Admin: admin@gmail.com / pass: admin <br>
        User: guest@gmail.com / pass: guest
    </p>
</div>
@endsection