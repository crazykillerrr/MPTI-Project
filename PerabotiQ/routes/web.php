<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/afterlogin', function () {
    return view('afterlogin');
});
Route::get('/aksesoris', function () {
    $products = \App\Models\Product::where('category', 'Aksesoris')->get();
    return view('aksesoris', compact('products'));
});
Route::get('/aksesorislog', function () {
    return redirect('/aksesoris');
});
Route::get('/kamar-mandi', function () {
    $products = \App\Models\Product::where('category', 'Kamar Mandi')->get();
    return view('kamar-mandi', compact('products'));
});
Route::get('/kamarmandilog', function () {
    return redirect('/kamar-mandi');
});
Route::get('/keranjang', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{cart}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/melacak', function () {
    return view('melacak');
});
Route::get('/product/{id}', function ($id) {
    $product = \App\Models\Product::findOrFail($id);
    return view('product-details', compact('product'));
})->name('product.details');
Route::get('/ruang-kerja', function () {
    $products = \App\Models\Product::where('category', 'Ruang Kerja')->get();
    return view('ruang-kerja', compact('products'));
});
Route::get('/ruangkerjalog', function () {
    return redirect('/ruang-kerja');
});
Route::get('/ruang-makan', function () {
    $products = \App\Models\Product::where('category', 'Ruang Makan')->get();
    return view('ruang-makan', compact('products'));
});
Route::get('/ruangmakanlog', function () {
    return redirect('/ruang-makan');
});
Route::get('/ruang-tamu', function () {
    $products = \App\Models\Product::where('category', 'Ruang Tamu')->get();
    return view('ruang-tamu', compact('products'));
});
Route::get('/ruangtamulog', function () {
    return redirect('/ruang-tamu');
});
Route::get('/ruang-tidur', function () {
    $products = \App\Models\Product::where('category', 'Kamar Tidur')->get();
    return view('ruang-tidur', compact('products'));
});
Route::get('/ruangtidurlog', function () {
    return redirect('/ruang-tidur');
});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/edit/{product}', [AdminController::class, 'edit'])->name('edit');
    Route::post('/update/{product}', [AdminController::class, 'update'])->name('update');
    Route::post('/destroy/{product}', [AdminController::class, 'destroy'])->name('destroy');
});

