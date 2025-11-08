<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\BinadesaController;
use App\Http\Controllers\DashboardController;

// Routes untuk Guest UMKM (Public)
Route::get('/', [UmkmController::class, 'beranda'])->name('home');
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm');
Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.show');// PERBAIKI INI

// Routes untuk Layanan dan Kontak (Public)
Route::get('/layanan', [UmkmController::class, 'layanan'])->name('layanan');
Route::get('/kontak', [UmkmController::class, 'kontak'])->name('kontak');
Route::get('/about', [UmkmController::class, 'about'])->name('about');
// Route::get('/umkm', [UmkmController::class, 'umkm'])->name('umkm');
Route::post('/kirim-pesan', [UmkmController::class, 'kirimPesan'])->name('kirim.pesan');

// Routes untuk Auth (Public)
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes untuk admin (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UsersController::class);
    Route::resource('binadesa', BinadesaController::class);
    Route::resource('warga', WargaController::class);
    Route::get('/api/warga', [WargaController::class, 'getWargaDropdown'])->name('api.warga');
    Route::get('/binadesa/create', [BinadesaController::class, 'create'])->name('binadesa.create');
    Route::post('/binadesa', [BinadesaController::class, 'store'])->name('binadesa.store');
});
