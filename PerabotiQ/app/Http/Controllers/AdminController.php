<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\DetailPesanan;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProduk    = Produk::count();
        $totalPesanan   = Pesanan::count();
        $totalTransaksi = Transaksi::count();
        $pendapatan     = Transaksi::where('status', 'lunas')->sum('total');
        return view('admin.dashboard', compact('totalProduk','totalPesanan','totalTransaksi','pendapatan'));
    }

    public function produkIndex()
    {
        $produk = Produk::orderByDesc('created_at')->get();
        return view('admin.produk.index', compact('produk'));
    }

    public function produkTambah()
    {
        return view('admin.produk.tambah');
    }

    public function produkSimpan(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string',
            'kategori' => 'required|string',
            'harga'    => 'required|numeric',
            'stok'     => 'required|numeric',
        ]);
        $data = $request->only('nama','kategori','deskripsi','harga','stok');
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk','public');
        }
        Produk::create($data);
        return redirect()->route('admin.produk')->with('success','Produk berhasil ditambahkan.');
    }

    public function produkEdit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    public function produkUpdate(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $data   = $request->only('nama','kategori','deskripsi','harga','stok');
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk','public');
        }
        $produk->update($data);
        return redirect()->route('admin.produk')->with('success','Produk berhasil diperbarui.');
    }

    public function produkHapus($id)
    {
        Produk::findOrFail($id)->delete();
        return redirect()->route('admin.produk')->with('success','Produk berhasil dihapus.');
    }

    public function pesananIndex()
    {
        $pesanan = Pesanan::with('user')->orderByDesc('created_at')->get();
        return view('admin.pesanan.index', compact('pesanan'));
    }

    public function pesananDetail($id)
    {
        $pesanan = Pesanan::with('user','detailPesanan.produk')->findOrFail($id);
        return view('admin.pesanan.detail', compact('pesanan'));
    }

    public function pesananUpdateStatus(Request $request, $id)
    {
        Pesanan::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success','Status pesanan berhasil diperbarui.');
    }

    public function transaksiIndex()
    {
        $transaksi = Transaksi::with('user','pesanan')->orderByDesc('created_at')->get();
        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function transaksiVerifikasi(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status' => $request->status]);
        if ($request->status === 'lunas') {
            $transaksi->pesanan->update(['status' => 'diproses']);
        }
        return back()->with('success','Transaksi berhasil diverifikasi.');
    }

    public function laporan()
    {
        $pendapatan = Transaksi::where('status','lunas')->sum('total');
        $terjual    = DetailPesanan::sum('qty');
        $perBulan   = Transaksi::where('status','lunas')
                        ->selectRaw("EXTRACT(MONTH FROM created_at) as bulan, SUM(total) as total")
                        ->groupBy('bulan')
                        ->orderBy('bulan')
                        ->get();
        return view('admin.laporan.index', compact('pendapatan','terjual','perBulan'));
    }
}
