<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BinadesaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// Routes untuk Guest UMKM (Public)
Route::get('/', [UmkmController::class, 'beranda'])->name('home');
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm');
Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.show');

// Routes untuk Ulasan Produk
Route::get('/produk/{produk}/ulasan/form', [UmkmController::class, 'showFormUlasan'])
    ->name('umkm.form-ulasan')
    ->middleware('auth');

Route::post('/produk/{produk}/ulasan', [UmkmController::class, 'tambahUlasan'])
    ->name('umkm.tambah-ulasan')
    ->middleware('auth');

Route::get('/produk/{produk}/ulasan', [UmkmController::class, 'tampilUlasan'])
    ->name('umkm.tampil-ulasan');

// Routes untuk Layanan dan Kontak (Public)
Route::get('/layanan', [UmkmController::class, 'layanan'])->name('layanan');
Route::get('/kontak', [UmkmController::class, 'kontak'])->name('kontak');
Route::get('/about', [UmkmController::class, 'about'])->name('about');
Route::post('/kirim-pesan', [UmkmController::class, 'kirimPesan'])->name('kirim.pesan');
Route::get('/creator', [UmkmController::class, 'creator'])->name('creator');

// Routes untuk Auth (Public)
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes untuk admin (protected)
Route::group(['middleware' => ['checkislogin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UsersController::class);
    Route::resource('binadesa', BinadesaController::class);
    Route::resource('warga', WargaController::class);
    Route::get('/api/warga', [WargaController::class, 'getWargaDropdown'])->name('api.warga');
    Route::get('/binadesa/create', [BinadesaController::class, 'create'])->name('binadesa.create');
    Route::post('/binadesa', [BinadesaController::class, 'store'])->name('binadesa.store');
    Route::delete('/binadesa/{binadesa}/hapus-logo', [BinadesaController::class, 'hapusLogo'])
        ->name('binadesa.hapus-logo');
    Route::resource('produk', ProdukController::class);
    Route::resource('pesanan', PesananController::class);
    Route::post('/pesanan/{pesanan}/update-status', [PesananController::class, 'updateStatus'])->name('pesanan.update-status');
    Route::post('/pesanan/{pesanan}/hapus-bukti', [PesananController::class, 'hapusBuktiBayar'])->name('pesanan.hapus-bukti');
    Route::post('/pesanan/{pesanan}/hapus-item', [PesananController::class, 'hapusItemDetail'])->name('pesanan.hapus-item');
});
// routes/web.php

Route::post('/api/check-stok', function(Request $request) {
    $request->validate([
        'produk_id' => 'required|exists:produk,produk_id',
        'qty' => 'required|integer|min:1'
    ]);

    $produk = Produk::find($request->produk_id);

    return response()->json([
        'stok_tersedia' => $produk->stok,
        'cukup' => $produk->stok >= $request->qty,
        'nama_produk' => $produk->nama_produk
    ]);
});
