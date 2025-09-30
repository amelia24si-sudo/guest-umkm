<?php

use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
  //  return view('welcome');
//});

// Routes untuk Guest UMKM
Route::get('/umkm', [UmkmController::class, 'index']);
Route::get('/umkm/detail/{id}', [UmkmController::class, 'show']);
