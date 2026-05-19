<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\ProdukController;

// ===================== PUBLIC ROUTES =====================

Route::get('/', fn() => view('index'))->name('home');

Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AuthController::class, 'login']);
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');

Route::get('/produk/{kategori}', [ProdukController::class, 'index'])
     ->where('kategori', 'aksesoris|kamar-mandi|ruang-kerja|ruang-makan|ruang-tamu|ruang-tidur')
     ->name('produk.kategori');

Route::get('/produk/detail/{id}', [ProdukController::class, 'show'])->name('produk.detail');

// ===================== CUSTOMER ROUTES =====================

Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

    Route::get('/produk/{kategori}/login', [CustomerController::class, 'kategoriLogin'])
         ->where('kategori', 'aksesoris|kamar-mandi|ruang-kerja|ruang-makan|ruang-tamu|ruang-tidur')
         ->name('produk.kategori.login');

    Route::get('/keranjang',         [CustomerController::class, 'keranjang'])->name('keranjang');
    Route::post('/keranjang/tambah', [CustomerController::class, 'tambahKeranjang'])->name('keranjang.tambah');
    Route::post('/keranjang/hapus',  [CustomerController::class, 'hapusKeranjang'])->name('keranjang.hapus');

    Route::get('/checkout',             [CustomerController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/konfirmasi', [CustomerController::class, 'konfirmasiCheckout'])->name('checkout.konfirmasi');

    Route::get('/pesanan',      [CustomerController::class, 'pesanan'])->name('customer.pesanan');
    Route::get('/pesanan/{id}', [CustomerController::class, 'pesananDetail'])->name('customer.pesanan.detail');
});

// ===================== ADMIN ROUTES =====================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/produk',               [AdminController::class, 'produkIndex'])->name('produk');
    Route::get('/produk/tambah',        [AdminController::class, 'produkTambah'])->name('produk.tambah');
    Route::post('/produk/simpan',       [AdminController::class, 'produkSimpan'])->name('produk.simpan');
    Route::get('/produk/edit/{id}',     [AdminController::class, 'produkEdit'])->name('produk.edit');
    Route::put('/produk/update/{id}',   [AdminController::class, 'produkUpdate'])->name('produk.update');
    Route::delete('/produk/hapus/{id}', [AdminController::class, 'produkHapus'])->name('produk.hapus');

    Route::get('/pesanan',              [AdminController::class, 'pesananIndex'])->name('pesanan');
    Route::get('/pesanan/{id}',         [AdminController::class, 'pesananDetail'])->name('pesanan.detail');
    Route::put('/pesanan/{id}/status',  [AdminController::class, 'pesananUpdateStatus'])->name('pesanan.status');

    Route::get('/transaksi',                 [AdminController::class, 'transaksiIndex'])->name('transaksi');
    Route::put('/transaksi/{id}/verifikasi', [AdminController::class, 'transaksiVerifikasi'])->name('transaksi.verifikasi');

    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
});

// ===================== KURIR ROUTES =====================

Route::middleware(['auth', 'kurir'])->prefix('kurir')->name('kurir.')->group(function () {
    Route::get('/dashboard', [KurirController::class, 'dashboard'])->name('dashboard');

    Route::get('/pickup',                  [KurirController::class, 'pickupIndex'])->name('pickup');
    Route::get('/pickup/{id}',             [KurirController::class, 'pickupDetail'])->name('pickup.detail');
    Route::post('/pickup/{id}/konfirmasi', [KurirController::class, 'pickupKonfirmasi'])->name('pickup.konfirmasi');

    Route::get('/pengiriman',              [KurirController::class, 'pengirimanIndex'])->name('pengiriman');
    Route::get('/pengiriman/{id}',         [KurirController::class, 'pengirimanDetail'])->name('pengiriman.detail');
    Route::put('/pengiriman/{id}/status',  [KurirController::class, 'updateStatus'])->name('pengiriman.status');

    Route::get('/kendala',        [KurirController::class, 'kendalaIndex'])->name('kendala');
    Route::post('/kendala/simpan', [KurirController::class, 'kendalaSimpan'])->name('kendala.simpan');
});
