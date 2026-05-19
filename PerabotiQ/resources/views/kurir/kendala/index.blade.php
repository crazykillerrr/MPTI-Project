@extends('layouts.kurir')
@section('title','Laporan Kendala')
@section('content')
<h1>Laporan Kendala Pengiriman</h1>
<div style="background:#fff;padding:24px;border-radius:10px;border:1px solid #e8e5e0;max-width:600px;">
    <form action="{{ route('kurir.kendala.simpan') }}" method="POST">
        @csrf
        <div style="margin-bottom:16px;">
            <label style="display:block;font-size:0.82rem;font-weight:600;margin-bottom:6px;">Pilih Pesanan</label>
            <select name="pesanan_id" style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:0.88rem;" required>
                <option value="">-- Pilih Pesanan --</option>
                @foreach($pesananAktif as $p)
                    <option value="{{ $p->id }}">Pesanan #{{ $p->id }}</option>
                @endforeach
            </select>
        </div>
        <div style="margin-bottom:16px;">
            <label style="display:block;font-size:0.82rem;font-weight:600;margin-bottom:6px;">Jenis Kendala</label>
            <select name="jenis" style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:0.88rem;" required>
                <option value="Alamat Tidak Ditemukan">Alamat Tidak Ditemukan</option>
                <option value="Penerima Tidak Ada">Penerima Tidak Ada</option>
                <option value="Akses Lokasi Sulit">Akses Lokasi Sulit</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div style="margin-bottom:20px;">
            <label style="display:block;font-size:0.82rem;font-weight:600;margin-bottom:6px;">Deskripsi Kendala</label>
            <textarea name="deskripsi" rows="4" style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:0.88rem;" placeholder="Jelaskan kendala yang dialami..." required></textarea>
        </div>
        <button type="submit" class="btn">Kirim Laporan</button>
    </form>
</div>
@endsection
