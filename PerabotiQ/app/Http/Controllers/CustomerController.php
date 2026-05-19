<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $produkRekomendasi = Produk::inRandomOrder()->take(6)->get();
        return view('afterlogin', compact('produkRekomendasi'));
    }

    // Keranjang
    public function keranjang()
    {
        $items = Keranjang::with('produk')->where('user_id', Auth::id())->get();
        $total = $items->sum(fn($i) => $i->produk->harga * $i->qty);
        // Backward compat: existing keranjang.blade.php uses $cartItems
        $cartItems = $items->map(function($item) {
            // Create a wrapper so $item->product->name etc. still work
            return $item;
        });
        return view('keranjang', compact('items', 'total', 'cartItems'));
    }

    public function tambahKeranjang(Request $request)
    {
        $produk = Produk::findOrFail($request->produk_id);
        if ($produk->stok < 1) {
            return back()->with('error', 'Stok produk habis.');
        }
        $item = Keranjang::firstOrNew([
            'user_id'   => Auth::id(),
            'produk_id' => $request->produk_id,
        ]);
        $item->qty = ($item->qty ?? 0) + 1;
        $item->save();
        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function hapusKeranjang(Request $request)
    {
        Keranjang::where('user_id', Auth::id())
                 ->where('id', $request->keranjang_id)
                 ->delete();
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    // Checkout
    public function checkout()
    {
        $items = Keranjang::with('produk')->where('user_id', Auth::id())->get();
        if ($items->isEmpty()) return redirect()->route('keranjang')->with('error', 'Keranjang kosong.');
        $total = $items->sum(fn($i) => $i->produk->harga * $i->qty);
        return view('customer.pesanan.checkout', compact('items', 'total'));
    }

    public function konfirmasiCheckout(Request $request)
    {
        $items = Keranjang::with('produk')->where('user_id', Auth::id())->get();
        if ($items->isEmpty()) return redirect()->route('keranjang');

        $total   = $items->sum(fn($i) => $i->produk->harga * $i->qty);
        $pesanan = Pesanan::create([
            'user_id'           => Auth::id(),
            'status'            => 'menunggu_pembayaran',
            'total'             => $total,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        foreach ($items as $item) {
            $pesanan->detailPesanan()->create([
                'produk_id' => $item->produk_id,
                'qty'       => $item->qty,
                'harga'     => $item->produk->harga,
            ]);
            $item->produk->decrement('stok', $item->qty);
        }

        Keranjang::where('user_id', Auth::id())->delete();

        Transaksi::create([
            'pesanan_id'        => $pesanan->id,
            'user_id'           => Auth::id(),
            'total'             => $total,
            'status'            => 'pending',
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect()->route('customer.pesanan')->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    // Lacak Pesanan
    public function pesanan()
    {
        $pesanan = Pesanan::with('detailPesanan.produk')
                          ->where('user_id', Auth::id())
                          ->orderByDesc('created_at')
                          ->get();
        return view('melacak', compact('pesanan'));
    }

    public function pesananDetail($id)
    {
        $pesanan = Pesanan::with('detailPesanan.produk')
                          ->where('user_id', Auth::id())
                          ->findOrFail($id);
        return view('customer.pesanan.detail', compact('pesanan'));
    }

    // Halaman kategori produk (versi login)
    public function kategoriLogin($kategori)
    {
        $viewMap = [
            'aksesoris'   => 'aksesorislog',
            'kamar-mandi' => 'kamarmandilog',
            'ruang-kerja' => 'ruangkerjalog',
            'ruang-makan' => 'ruangmakanlog',
            'ruang-tamu'  => 'ruangtamulog',
            'ruang-tidur' => 'ruangtidurlog',
        ];
        if (!isset($viewMap[$kategori])) abort(404);
        $products = Produk::where('kategori', $kategori)->get();
        return view($viewMap[$kategori], compact('products'));
    }
}
