@extends('layouts.kurir')
@section('title', 'Delivery Status')
@section('content')

{{-- Header --}}
<div class="card" style="margin-bottom:18px;">
    <div class="page-title">Delivery Status</div>
    <div class="page-sub">Track and manage your active deliveries</div>
</div>

{{-- Table --}}
<div class="card">
    <div class="section-title">Active Deliveries</div>
    <table>
        <thead>
            <tr>
                <th>Package ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesanan as $p)
            <tr>
                <td style="font-weight:600; font-size:0.82rem; color:#6B6560;">#{{ $p->id }}</td>
                <td>{{ $p->user->name ?? '-' }}</td>
                <td style="color:#6B6560;">Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                <td><span class="badge badge-yellow">In Transit</span></td>
                <td>
                    <a href="{{ route('kurir.pengiriman.detail', $p->id) }}" class="btn btn-outline">Update Status</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; color:#ADA8A0; padding:32px; font-size:0.85rem;">No active deliveries at the moment.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
