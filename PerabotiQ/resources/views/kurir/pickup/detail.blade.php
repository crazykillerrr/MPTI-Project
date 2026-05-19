@extends('layouts.kurir')
@section('title', 'Package Details')
@section('content')

{{-- Header --}}
<div class="card" style="margin-bottom:18px; display:flex; justify-content:space-between; align-items:center;">
    <div>
        <div class="page-title">Package Details</div>
        <div class="page-sub">Order #{{ $pesanan->id }}</div>
    </div>
    <a href="{{ route('kurir.pickup') }}" class="btn btn-outline">Back</a>
</div>

{{-- Info card --}}
<div class="card" style="max-width:640px; margin-bottom:14px;">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; padding-bottom:18px; margin-bottom:18px; border-bottom:1px solid #E0DCD6;">
        <div>
            <div style="font-size:0.72rem; font-weight:600; color:#8C877F; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Customer</div>
            <div style="font-size:0.93rem; font-weight:500;">{{ $pesanan->user->name }}</div>
        </div>
        <div>
            <div style="font-size:0.72rem; font-weight:600; color:#8C877F; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Order Total</div>
            <div style="font-size:0.93rem; font-weight:600;">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="section-title" style="margin-bottom:12px;">Items</div>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan->detailPesanan as $d)
            <tr>
                <td>{{ $d->produk->nama ?? '-' }}</td>
                <td style="color:#6B6560;">{{ $d->qty }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Actions --}}
<div style="display:flex; gap:10px;">
    <form action="{{ route('kurir.pickup.konfirmasi', $pesanan->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-solid" onclick="return confirm('Confirm pickup?')">Confirm Pickup</button>
    </form>
    <a href="{{ route('kurir.pickup') }}" class="btn btn-outline">Cancel</a>
</div>

@endsection
