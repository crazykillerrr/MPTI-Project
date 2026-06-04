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
        $produkRekomendasi = Produk::inRandomOrder()->take(10)->get();
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

    // Terima pilihan item dari keranjang, simpan ke session, redirect ke checkout
    public function pilihCheckout(Request $request)
    {
        $selectedIds = $request->input('selected_ids', []);

        if (empty($selectedIds)) {
            return redirect()->route('keranjang')->with('error', 'Pilih minimal satu produk untuk checkout.');
        }

        // Validasi: pastikan ID milik user yang sedang login
        $validIds = Keranjang::where('user_id', Auth::id())
                             ->whereIn('id', $selectedIds)
                             ->pluck('id')
                             ->toArray();

        if (empty($validIds)) {
            return redirect()->route('keranjang')->with('error', 'Item yang dipilih tidak valid.');
        }

        // Simpan ID yang valid ke session
        session(['checkout_selected_ids' => $validIds]);

        return redirect()->route('checkout');
    }

    // Checkout — hanya tampilkan item yang dipilih dari session
    public function checkout()
    {
        $selectedIds = session('checkout_selected_ids', []);

        if (empty($selectedIds)) {
            return redirect()->route('keranjang')->with('error', 'Pilih minimal satu produk untuk checkout.');
        }

        $items = Keranjang::with('produk')
                          ->where('user_id', Auth::id())
                          ->whereIn('id', $selectedIds)
                          ->get();

        if ($items->isEmpty()) return redirect()->route('keranjang')->with('error', 'Keranjang kosong.');
        $total = $items->sum(fn($i) => $i->produk->harga * $i->qty);
        return view('customer.pesanan.checkout', compact('items', 'total'));
    }

    public function konfirmasiCheckout(Request $request)
    {
        // Ambil hanya item yang dipilih dari session
        $selectedIds = session('checkout_selected_ids', []);

        if (empty($selectedIds)) {
            return redirect()->route('keranjang')->with('error', 'Sesi checkout tidak valid, silakan pilih ulang.');
        }

        $items = Keranjang::with('produk')
                          ->where('user_id', Auth::id())
                          ->whereIn('id', $selectedIds)
                          ->get();

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

        // Hanya hapus item yang di-checkout, bukan semua isi keranjang
        Keranjang::where('user_id', Auth::id())
                 ->whereIn('id', $selectedIds)
                 ->delete();

        // Bersihkan session pilihan
        session()->forget('checkout_selected_ids');

        Transaksi::create([
            'pesanan_id'        => $pesanan->id,
            'user_id'           => Auth::id(),
            'total'             => $total,
            'status'            => 'pending',
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect()->route('customer.pesanan')->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    // Profil Customer
    public function profil()
    {
        $user = Auth::user();
        return view('customer.profil', compact('user'));
    }

    // Lacak Pesanan
    public function pesanan()
    {
        $pesanan = Pesanan::with('detailPesanan.produk', 'transaksi')
                          ->where('user_id', Auth::id())
                          ->orderByDesc('created_at')
                          ->get();
        return view('customer.pesanan.index', compact('pesanan'));
    }

    public function pesananDetail($id)
    {
        $pesanan = Pesanan::with('detailPesanan.produk', 'transaksi', 'user')
                          ->where('user_id', Auth::id())
                          ->findOrFail($id);
        return view('customer.pesanan.detail', compact('pesanan'));
    }

    // Konfirmasi Penerimaan Pesanan
    public function konfirmasiTerima($id)
    {
        $pesanan = Pesanan::where('user_id', Auth::id())->findOrFail($id);

        // Hanya boleh konfirmasi jika status dalam_pengiriman atau terkirim
        if (!in_array($pesanan->status, ['dalam_pengiriman', 'terkirim'])) {
            return back()->with('error', 'Pesanan tidak dapat dikonfirmasi pada status ini.');
        }

        $pesanan->update(['status' => 'selesai']);

        // Update transaksi menjadi lunas jika belum
        if ($pesanan->transaksi && $pesanan->transaksi->status !== 'lunas') {
            $pesanan->transaksi->update(['status' => 'lunas']);
        }

        return redirect()->route('customer.pesanan')
                         ->with('success', 'Pesanan berhasil dikonfirmasi! Terima kasih sudah berbelanja di PerabotiQ. 🎉');
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
