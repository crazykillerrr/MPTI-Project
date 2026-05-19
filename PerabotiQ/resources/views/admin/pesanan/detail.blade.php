@extends('layouts.admin')
@section('title','Detail Pesanan')
@section('content')
<h1>Detail Pesanan #{{ $pesanan->id }}</h1>
<div style="background:#fff;padding:24px;border-radius:10px;border:1px solid #e8e5e0;max-width:700px;margin-bottom:24px;">
    <p style="margin-bottom:8px;font-size:0.88rem;"><strong>Customer:</strong> {{ $pesanan->user->name }}</p>
    <p style="margin-bottom:8px;font-size:0.88rem;"><strong>Total:</strong> Rp.{{ number_format($pesanan->total,0,',','.') }}</p>
    <p style="margin-bottom:8px;font-size:0.88rem;"><strong>Status:</strong> {{ str_replace('_',' ',ucfirst($pesanan->status)) }}</p>
    <p style="margin-bottom:20px;font-size:0.88rem;"><strong>Tanggal:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>
    <table style="margin-bottom:20px;">
        <thead><tr><th>Produk</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr></thead>
        <tbody>
            @foreach($pesanan->detailPesanan as $d)
            <tr>
                <td>{{ $d->produk->nama }}</td>
                <td>{{ $d->qty }}</td>
                <td>Rp.{{ number_format($d->harga,0,',','.') }}</td>
                <td>Rp.{{ number_format($d->harga * $d->qty,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('admin.pesanan.status', $pesanan->id) }}" method="POST" style="display:flex;gap:12px;align-items:center;">
        @csrf @method('PUT')
        <select name="status" style="padding:8px 14px;border:1px solid #ddd;border-radius:6px;font-size:0.88rem;">
            @foreach(['diproses','dikemas','siap_kirim','dalam_pengiriman','terkirim'] as $s)
                <option value="{{ $s }}" {{ $pesanan->status==$s?'selected':'' }}>{{ str_replace('_',' ',ucfirst($s)) }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn">Update Status</button>
    </form>
</div>
<a href="{{ route('admin.pesanan') }}" class="btn">← Kembali</a>
@endsection
