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
Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.show');

// Routes untuk Layanan dan Kontak (Public)
Route::get('/layanan', [UmkmController::class, 'layanan'])->name('layanan');
Route::get('/kontak', [UmkmController::class, 'kontak'])->name('kontak');
Route::get('/about', [UmkmController::class, 'about'])->name('about');
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
    Route::resource('produk', ProdukController::class);

    // Routes untuk Pesanan
    Route::resource('pesanan', PesananController::class);

    // Tambahan routes untuk Pesanan (versi sederhana)
    Route::post('/pesanan/{pesanan}/update-status', [PesananController::class, 'updateStatus'])->name('pesanan.update-status');
    Route::post('/pesanan/{pesanan}/upload-bukti', [PesananController::class, 'uploadBuktiBayar'])->name('pesanan.upload-bukti');
    Route::get('/pesanan/dashboard', [PesananController::class, 'dashboard'])->name('pesanan.dashboard');
    Route::get('/pesanan/laporan', [PesananController::class, 'laporan'])->name('pesanan.laporan');
    Route::get('/pesanan/warga/{warga}', [PesananController::class, 'getByWarga'])->name('pesanan.by-warga');
});
