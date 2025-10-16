<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\DashboardController;


// Routes untuk Guest UMKM
Route::get('/umkm', [UmkmController::class, 'index']);
Route::get('/umkm/detail/{id}', [UmkmController::class, 'show']);

// Routes untuk Auth
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route untuk admin
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
