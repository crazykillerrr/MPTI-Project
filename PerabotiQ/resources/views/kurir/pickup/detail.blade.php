@extends('layouts.kurir')
@section('title','Detail Pickup')
@section('content')
<h1>Detail Pesanan #{{ $pesanan->id }}</h1>
<div style="background:#fff;padding:24px;border-radius:10px;border:1px solid #e8e5e0;max-width:600px;margin-bottom:20px;">
    <p style="margin-bottom:8px;font-size:0.88rem;"><strong>Customer:</strong> {{ $pesanan->user->name }}</p>
    <p style="margin-bottom:16px;font-size:0.88rem;"><strong>Total:</strong> Rp.{{ number_format($pesanan->total,0,',','.') }}</p>
    <table>
        <thead><tr><th>Produk</th><th>Qty</th></tr></thead>
        <tbody>
            @foreach($pesanan->detailPesanan as $d)
            <tr><td>{{ $d->produk->nama }}</td><td>{{ $d->qty }}</td></tr>
            @endforeach
        </tbody>
    </table>
</div>
<form action="{{ route('kurir.pickup.konfirmasi', $pesanan->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn" onclick="return confirm('Konfirmasi pengambilan barang?')">✓ Konfirmasi Pengambilan</button>
</form>
<a href="{{ route('kurir.pickup') }}" class="btn" style="margin-left:10px;">← Kembali</a>
@endsection
