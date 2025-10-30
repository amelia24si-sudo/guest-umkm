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
Route::get('/beranda', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/umkm/detail/{id}', [UmkmController::class, 'show'])->name('umkm.show');

// Routes untuk Layanan dan Kontak (Public)
Route::get('/layanan', [UmkmController::class, 'layanan'])->name('layanan');
Route::get('/kontak', [UmkmController::class, 'kontak'])->name('kontak');
Route::post('/kirim-pesan', [UmkmController::class, 'kirimPesan'])->name('kirim.pesan');

// Routes untuk Auth (Public)
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register'); // TAMBAH INI
Route::post('/register', [AuthController::class, 'register'])->name('register.post'); // TAMBAH INI
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::resource('user', UserControllers::class);

// Routes untuk admin (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UsersController::class);
    Route::resource('binadesa', BinadesaController::class);
    Route::resource('warga', WargaController::class);
    Route::get('/api/warga', [WargaController::class, 'getWargaDropdown'])->name('api.warga');

    // Routes untuk UMKM yang membutuhkan login (TAMBAH INI)
    Route::get('/binadesa/create', [BinadesaController::class, 'create'])->name('binadesa.create');
    Route::post('/binadesa', [BinadesaController::class, 'store'])->name('binadesa.store');
});

// Route fallback atau home
Route::get('/', function () {
    return redirect()->route('umkm.index');
});
