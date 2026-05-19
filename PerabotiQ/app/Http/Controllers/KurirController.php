<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Kendala;
use Illuminate\Support\Facades\Auth;

class KurirController extends Controller
{
    public function dashboard()
    {
        $siapKirim  = Pesanan::where('status','siap_kirim')->count();
        $dalamKirim = Pesanan::where('kurir_id', Auth::id())->where('status','dalam_pengiriman')->count();
        return view('kurir.dashboard', compact('siapKirim','dalamKirim'));
    }

    public function pickupIndex()
    {
        $pesanan = Pesanan::with('user')->where('status','siap_kirim')->get();
        return view('kurir.pickup.index', compact('pesanan'));
    }

    public function pickupDetail($id)
    {
        $pesanan = Pesanan::with('user','detailPesanan.produk')->findOrFail($id);
        return view('kurir.pickup.detail', compact('pesanan'));
    }

    public function pickupKonfirmasi($id)
    {
        Pesanan::findOrFail($id)->update([
            'status'   => 'dalam_pengiriman',
            'kurir_id' => Auth::id(),
        ]);
        return redirect()->route('kurir.pengiriman')->with('success','Barang berhasil diambil.');
    }

    public function pengirimanIndex()
    {
        $pesanan = Pesanan::with('user')
                          ->where('kurir_id', Auth::id())
                          ->where('status','dalam_pengiriman')
                          ->get();
        return view('kurir.pengiriman.index', compact('pesanan'));
    }

    public function pengirimanDetail($id)
    {
        $pesanan = Pesanan::with('user','detailPesanan.produk')->findOrFail($id);
        return view('kurir.pengiriman.detail', compact('pesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:terkirim,gagal_kirim']);
        Pesanan::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success','Status pengiriman berhasil diperbarui.');
    }

    public function kendalaIndex()
    {
        $pesananAktif = Pesanan::where('kurir_id', Auth::id())
                               ->where('status','dalam_pengiriman')
                               ->get();
        return view('kurir.kendala.index', compact('pesananAktif'));
    }

    public function kendalaSimpan(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required|exists:pesanans,id',
            'jenis'      => 'required|string',
            'deskripsi'  => 'required|string',
        ]);
        Kendala::create([
            'pesanan_id' => $request->pesanan_id,
            'kurir_id'   => Auth::id(),
            'jenis'      => $request->jenis,
            'deskripsi'  => $request->deskripsi,
        ]);
        Pesanan::findOrFail($request->pesanan_id)->update(['status' => 'gagal_kirim']);
        return back()->with('success','Kendala berhasil dilaporkan.');
    }
}
