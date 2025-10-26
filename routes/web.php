<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\BinadesaController;
use App\Http\Controllers\DashboardController;

// Routes untuk Guest UMKM
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/umkm/detail/{id}', [UmkmController::class, 'show'])->name('umkm.show');

// Routes untuk Auth
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (harus login)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', UserController::class);

    // Other resources
    Route::resource('binadesa', BinadesaController::class);
    Route::resource('warga', WargaController::class);
    Route::get('/api/warga', [WargaController::class, 'getWargaDropdown'])
        ->name('api.warga');
});
