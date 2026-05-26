<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth') 
    ->name('logout');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/', [AdminController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');

        Route::get('/pendaftar/list', [AdminController::class, 'pendaftar'])->name('pendaftar');
        Route::patch('/pendaftar/{id}/approve', [AdminController::class, 'approve'])->name('approve');
        Route::patch('/pendaftar/{id}/reject', [AdminController::class, 'reject'])->name('reject');

        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    });

Route::middleware(['auth', 'role:user,admin'])
    ->prefix('user')
    ->name('user.')
    ->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/daftar/{id}', [UserController::class, 'showDaftarForm'])->name('daftar');
        Route::post('/daftar', [UserController::class, 'storePendaftar'])->name('daftar.store');
        Route::get('/riwayat', [UserController::class, 'riwayat'])->name('riwayat');
    });

