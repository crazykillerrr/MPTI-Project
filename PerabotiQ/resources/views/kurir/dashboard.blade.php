@extends('layouts.kurir')
@section('title', 'Courier Dashboard')
@section('content')

@php
    $terkirim     = \App\Models\Pesanan::where('kurir_id', auth()->id())->where('status','terkirim')->count();
    $kendalaCount = \App\Models\Kendala::where('kurir_id', auth()->id())->count();
    $recentPesanan = \App\Models\Pesanan::with('user')
                        ->where('kurir_id', auth()->id())
                        ->latest()->take(6)->get();
@endphp

{{-- Header --}}
<div class="card" style="margin-bottom:18px; display:flex; justify-content:space-between; align-items:center;">
    <div>
        <div class="page-title">Courier Dashboard</div>
        <div class="page-sub">Welcome back, {{ Auth::user()->name }}</div>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-ghost">Logout</button>
    </form>
</div>

{{-- Stats --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:18px;">
    @php
        $stats = [
            [
                'label' => 'Total Deliveries',
                'value' => $siapKirim + $dalamKirim + $terkirim,
                'svg'   => '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>',
            ],
            [
                'label' => 'In Transit',
                'value' => $dalamKirim,
                'svg'   => '<rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
            ],
            [
                'label' => 'Delivered',
                'value' => $terkirim,
                'svg'   => '<polyline points="20 6 9 17 4 12"/>',
            ],
            [
                'label' => 'Issues',
                'value' => $kendalaCount,
                'svg'   => '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
            ],
        ];
    @endphp

    @foreach($stats as $s)
    <div class="card" style="padding:18px;">
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
            <div class="stat-icon">
                <svg width="16" height="16" fill="none" stroke="#6B6560" stroke-width="1.7" viewBox="0 0 24 24">{!! $s['svg'] !!}</svg>
            </div>
        </div>
        <div style="font-size:1.85rem; font-weight:700; color:#2D2A26; line-height:1; margin-bottom:5px;">{{ $s['value'] }}</div>
        <div style="font-size:0.78rem; color:#8C877F; font-weight:500;">{{ $s['label'] }}</div>
    </div>
    @endforeach
</div>

{{-- Quick actions --}}
<div style="display:grid; grid-template-columns:repeat(2,1fr); gap:14px; margin-bottom:18px;">
    <a href="{{ route('kurir.pickup') }}" class="card" style="text-decoration:none; display:flex; align-items:center; gap:14px; padding:18px;">
        <div class="stat-icon">
            <svg width="16" height="16" fill="none" stroke="#6B6560" stroke-width="1.7" viewBox="0 0 24 24">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>
            </svg>
        </div>
        <div>
            <div style="font-size:0.93rem; font-weight:600; color:#2D2A26; margin-bottom:2px;">Pickup New Package</div>
            <div style="font-size:0.8rem; color:#8C877F;">View packages ready for pickup</div>
        </div>
    </a>
    <a href="{{ route('kurir.kendala') }}" class="card" style="text-decoration:none; display:flex; align-items:center; gap:14px; padding:18px;">
        <div class="stat-icon">
            <svg width="16" height="16" fill="none" stroke="#6B6560" stroke-width="1.7" viewBox="0 0 24 24">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
        </div>
        <div>
            <div style="font-size:0.93rem; font-weight:600; color:#2D2A26; margin-bottom:2px;">Report Issue</div>
            <div style="font-size:0.8rem; color:#8C877F;">Log delivery problems</div>
        </div>
    </a>
</div>

{{-- Recent deliveries --}}
<div class="card">
    <div class="section-title">Recent Deliveries</div>
    <table>
        <thead>
            <tr>
                <th>Package ID</th>
                <th>Recipient</th>
                <th>Status</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentPesanan as $p)
            <tr>
                <td style="font-weight:600; font-size:0.82rem; color:#6B6560;">#{{ $p->id }}</td>
                <td>{{ $p->user->name ?? '-' }}</td>
                <td>
                    @if($p->status === 'dalam_pengiriman')
                        <span class="badge badge-yellow">In Transit</span>
                    @elseif($p->status === 'terkirim')
                        <span class="badge badge-green">Delivered</span>
                    @elseif($p->status === 'gagal_kirim')
                        <span class="badge badge-red">Failed</span>
                    @else
                        <span class="badge badge-neutral">{{ $p->status }}</span>
                    @endif
                </td>
                <td style="color:#8C877F; font-size:0.8rem;">{{ $p->updated_at->format('d M, H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center; color:#ADA8A0; padding:30px; font-size:0.85rem;">No recent deliveries.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
