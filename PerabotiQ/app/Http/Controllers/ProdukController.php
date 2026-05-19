<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index($kategori = null)
    {
        // Redirect logged-in customers to the authenticated version
        if (Auth::check() && Auth::user()->role === 'customer') {
            return redirect()->route('produk.kategori.login', $kategori);
        }

        $viewMap = [
            'aksesoris'   => 'aksesoris',
            'kamar-mandi' => 'kamar-mandi',
            'ruang-kerja' => 'ruang-kerja',
            'ruang-makan' => 'ruang-makan',
            'ruang-tamu'  => 'ruang-tamu',
            'ruang-tidur' => 'ruang-tidur',
        ];
        if (!isset($viewMap[$kategori])) abort(404);
        $products = Produk::where('kategori', $kategori)->get();
        return view($viewMap[$kategori], compact('products'));
    }

    public function show($id)
    {
        $product = Produk::findOrFail($id);
        return view('product-details', compact('product'));
    }
}
