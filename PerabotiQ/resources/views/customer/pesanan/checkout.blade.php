@extends('layouts.app')
@section('title','Checkout')
@section('content')
<div style="max-width:700px;margin:40px auto;padding:0 20px;">
    <h2 style="font-size:1.4rem;font-weight:700;margin-bottom:24px;">Checkout</h2>
    <div style="background:#fff;border:1px solid #e8e5e0;border-radius:10px;padding:24px;margin-bottom:20px;">
        <h3 style="font-size:1rem;font-weight:600;margin-bottom:16px;">Ringkasan Pesanan</h3>
        @foreach($items as $item)
        <div style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f0eeeb;font-size:0.9rem;">
            <span>{{ $item->produk->nama }} × {{ $item->qty }}</span>
            <span>Rp.{{ number_format($item->produk->harga * $item->qty, 0, ',', '.') }}</span>
        </div>
        @endforeach
        <div style="display:flex;justify-content:space-between;padding:14px 0 0;font-weight:700;">
            <span>Total</span>
            <span>Rp.{{ number_format($total,0,',','.') }}</span>
        </div>
    </div>
    <form action="{{ route('checkout.konfirmasi') }}" method="POST" style="background:#fff;border:1px solid #e8e5e0;border-radius:10px;padding:24px;">
        @csrf
        <h3 style="font-size:1rem;font-weight:600;margin-bottom:16px;">Metode Pembayaran</h3>
        @foreach(['Transfer Bank','COD (Bayar di Tempat)','QRIS'] as $m)
        <label style="display:flex;align-items:center;gap:10px;margin-bottom:12px;font-size:0.9rem;cursor:pointer;">
            <input type="radio" name="metode_pembayaran" value="{{ $m }}" {{ $loop->first?'checked':'' }}>
            {{ $m }}
        </label>
        @endforeach
        <button type="submit" style="margin-top:16px;width:100%;padding:12px;border:1.5px solid #1a1a1a;background:#1a1a1a;color:#fff;border-radius:20px;font-size:0.95rem;cursor:pointer;">Konfirmasi Pesanan</button>
    </form>
</div>
@endsection
