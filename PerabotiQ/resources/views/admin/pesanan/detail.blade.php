@extends('layouts.admin')
@section('title','Order Details')
@section('content')
<div class="page-header">
    <div>
        <h1><i class="bi bi-receipt" style="color:var(--accent);margin-right:8px;"></i>Order Details #{{ $pesanan->id }}</h1>
        <p>Complete order information</p>
    </div>
    <a href="{{ route('admin.pesanan') }}" class="btn"><i class="bi bi-arrow-left"></i> Back</a>
</div>

<div class="detail-card">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
        <div>
            <div class="detail-row">
                <span class="detail-label"><i class="bi bi-person-fill" style="margin-right:6px;color:var(--accent);"></i> Customer</span>
                <span class="detail-value">{{ $pesanan->user->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="bi bi-calendar3" style="margin-right:6px;color:var(--accent);"></i> Date</span>
                <span class="detail-value">{{ $pesanan->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
        <div>
            <div class="detail-row">
                <span class="detail-label"><i class="bi bi-cash-coin" style="margin-right:6px;color:var(--accent);"></i> Total</span>
                <span class="detail-value" style="font-weight:700;color:var(--accent);">Rp{{ number_format($pesanan->total,0,',','.') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="bi bi-info-circle-fill" style="margin-right:6px;color:var(--accent);"></i> Status</span>
                <span class="detail-value"><span class="badge badge-info">{{ str_replace('_',' ',ucfirst($pesanan->status)) }}</span></span>
            </div>
        </div>
    </div>

    <h3 style="font-size:0.92rem;font-weight:600;margin-bottom:12px;color:var(--text-secondary);"><i class="bi bi-list-ul" style="margin-right:6px;"></i>Order Items</h3>
    <div class="table-container" style="margin-bottom:24px;">
        <table>
            <thead><tr><th>Product</th><th>Qty</th><th>Price</th><th style="text-align:right;">Subtotal</th></tr></thead>
            <tbody>
                @foreach($pesanan->detailPesanan as $d)
                <tr>
                    <td style="font-weight:500;">{{ $d->produk->nama }}</td>
                    <td><span class="badge badge-neutral">{{ $d->qty }}×</span></td>
                    <td>Rp{{ number_format($d->harga,0,',','.') }}</td>
                    <td style="text-align:right;font-weight:600;">Rp{{ number_format($d->harga * $d->qty,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h3 style="font-size:0.92rem;font-weight:600;margin-bottom:12px;color:var(--text-secondary);"><i class="bi bi-arrow-repeat" style="margin-right:6px;"></i>Update Status</h3>
    <form action="{{ route('admin.pesanan.status', $pesanan->id) }}" method="POST" style="display:flex;gap:12px;align-items:center;">
        @csrf @method('PUT')
        <select name="status" class="form-control" style="max-width:240px;">
            @foreach(['diproses','dikemas','siap_kirim','dalam_pengiriman','terkirim'] as $s)
                <option value="{{ $s }}" {{ $pesanan->status==$s?'selected':'' }}>{{ str_replace('_',' ',ucfirst($s)) }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Update</button>
    </form>
</div>
@endsection
