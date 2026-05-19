@extends('layouts.kurir')
@section('title', 'Package Pickup')
@section('content')

{{-- Header --}}
<div class="card" style="margin-bottom:18px;">
    <div class="page-title">Package Pickup</div>
    <div class="page-sub">Select packages to pick up for delivery</div>
</div>

{{-- Table --}}
<div class="card">
    <div class="section-title">Available Packages</div>
    <table>
        <thead>
            <tr>
                <th>Package ID</th>
                <th>Customer</th>
                <th>Recipient</th>
                <th>Weight</th>
                <th>Priority</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesanan as $p)
            <tr>
                <td style="font-weight:600; font-size:0.82rem; color:#6B6560;">#{{ $p->id }}</td>
                <td>{{ $p->user->name ?? '-' }}</td>
                <td>{{ $p->penerima ?? $p->user->name ?? '-' }}</td>
                <td style="color:#6B6560;">{{ isset($p->berat) ? $p->berat.' kg' : '—' }}</td>
                <td>
                    @if(($p->prioritas ?? '') === 'Express')
                        <span class="badge badge-rose">Express</span>
                    @else
                        <span class="badge badge-slate">Standard</span>
                    @endif
                </td>
                <td style="color:#8C877F; font-size:0.8rem;">{{ $p->created_at->format('d M, H:i') }}</td>
                <td>
                    <div style="display:flex; gap:7px;">
                        <a href="{{ route('kurir.pickup.detail', $p->id) }}" class="btn btn-outline">Details</a>
                        <form action="{{ route('kurir.pickup.konfirmasi', $p->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-solid" onclick="return confirm('Pick up this package?')">Pickup</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; color:#ADA8A0; padding:32px; font-size:0.85rem;">No packages available for pickup.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
