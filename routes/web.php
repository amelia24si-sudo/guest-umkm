<?php

use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;


// Routes untuk Guest UMKM
Route::get('/umkm', [UmkmController::class, 'index']);
Route::get('/umkm/detail/{id}', [UmkmController::class, 'show']);

// Routes untuk Auth
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);