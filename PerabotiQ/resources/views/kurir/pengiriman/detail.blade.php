@extends('layouts.kurir')
@section('title','Update Pengiriman')
@section('content')
<h1>Update Status Pengiriman #{{ $pesanan->id }}</h1>
<div style="background:#fff;padding:24px;border-radius:10px;border:1px solid #e8e5e0;max-width:500px;">
    <p style="margin-bottom:16px;font-size:0.88rem;"><strong>Customer:</strong> {{ $pesanan->user->name }}</p>
    <form action="{{ route('kurir.pengiriman.status', $pesanan->id) }}" method="POST">
        @csrf @method('PUT')
        <div style="margin-bottom:16px;">
            <label style="display:block;font-size:0.82rem;font-weight:600;margin-bottom:6px;">Status Pengiriman</label>
            <select name="status" style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:0.88rem;">
                <option value="terkirim">Terkirim</option>
                <option value="gagal_kirim">Gagal Dikirim</option>
            </select>
        </div>
        <button type="submit" class="btn">Simpan Status</button>
    </form>
</div>
<a href="{{ route('kurir.pengiriman') }}" class="btn" style="margin-top:12px;display:inline-block;">← Kembali</a>
@endsection
