@extends('layouts.app')
@section('title','Detail Pesanan #'.$pesanan->id)
@section('content')
@php
  $statusSteps = ['menunggu_pembayaran', 'diproses', 'dikirim', 'selesai'];
  $statusLabels = [
    'menunggu_pembayaran' => 'Menunggu Pembayaran',
    'diproses' => 'Sedang Diproses',
    'dikirim' => 'Sedang Dikirim',
    'selesai' => 'Pesanan Selesai',
    'dibatalkan' => 'Dibatalkan',
  ];
  $statusIcons = [
    'menunggu_pembayaran' => 'bi-credit-card',
    'diproses' => 'bi-gear',
    'dikirim' => 'bi-truck',
    'selesai' => 'bi-check-circle',
    'dibatalkan' => 'bi-x-circle',
  ];
  $currentStepIndex = array_search($pesanan->status, $statusSteps);
  if ($currentStepIndex === false) $currentStepIndex = -1;
  $isCancelled = $pesanan->status === 'dibatalkan';
@endphp

<div style="max-width:800px;margin:40px auto;padding:0 20px;">
    <a href="{{ route('customer.pesanan') }}" style="font-size:0.88rem;color:#1a1a1a;text-decoration:none;display:inline-flex;align-items:center;gap:6px;margin-bottom:20px;">
        <i class="bi bi-arrow-left"></i> Kembali ke Pesanan Saya
    </a>

    <h2 style="font-size:1.4rem;font-weight:700;margin-bottom:8px;">
        <i class="bi bi-receipt"></i> Pesanan #{{ $pesanan->id }}
    </h2>
    <p style="font-size:0.85rem;color:#888;margin-bottom:24px;">
        <i class="bi bi-calendar3"></i> {{ $pesanan->created_at->format('d M Y, H:i') }}
        @if($pesanan->metode_pembayaran)
        &nbsp;•&nbsp; {{ $pesanan->metode_pembayaran }}
        @endif
    </p>

    <!-- Order Tracking Timeline -->
    <div style="background:#fff;border:1px solid #e8e5e0;border-radius:12px;padding:28px;margin-bottom:24px;">
        <h3 style="font-size:1rem;font-weight:600;margin-bottom:20px;">
            <i class="bi bi-geo-alt"></i> Status Pesanan
        </h3>

        @if($isCancelled)
        <div style="display:flex;align-items:center;gap:12px;padding:16px;background:#fce4ec;border-radius:10px;">
            <i class="bi bi-x-circle-fill" style="font-size:1.8rem;color:#c62828;"></i>
            <div>
                <p style="font-weight:600;margin:0;color:#c62828;">Pesanan Dibatalkan</p>
                <p style="font-size:0.82rem;margin:0;color:#888;">Pesanan ini telah dibatalkan</p>
            </div>
        </div>
        @else
        <div style="display:flex;justify-content:space-between;position:relative;padding:0 10px;">
            <!-- Progress Line -->
            <div style="position:absolute;top:20px;left:40px;right:40px;height:3px;background:#e8e5e0;z-index:0;border-radius:2px;">
                @if($currentStepIndex > 0)
                <div style="height:100%;background:linear-gradient(90deg, #2e7d32, #43a047);border-radius:2px;width:{{ ($currentStepIndex / (count($statusSteps) - 1)) * 100 }}%;transition:width 0.5s;"></div>
                @endif
            </div>

            @foreach($statusSteps as $i => $step)
            @php
              $isActive = $i <= $currentStepIndex;
              $isCurrent = $i === $currentStepIndex;
            @endphp
            <div style="display:flex;flex-direction:column;align-items:center;z-index:1;flex:1;">
                <div style="width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;
                    {{ $isActive ? 'background:linear-gradient(135deg, #2e7d32, #43a047);color:#fff;' : 'background:#f5f3f0;color:#aaa;' }}
                    {{ $isCurrent ? 'box-shadow:0 0 0 4px rgba(46,125,50,0.2);' : '' }}
                    font-size:1.1rem;transition:all 0.3s;">
                    <i class="bi {{ $statusIcons[$step] }}"></i>
                </div>
                <p style="font-size:0.72rem;margin-top:8px;text-align:center;font-weight:{{ $isCurrent ? '600' : '400' }};color:{{ $isActive ? '#1a1a1a' : '#aaa' }};">
                    {{ $statusLabels[$step] }}
                </p>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Order Items -->
    <div style="background:#fff;border:1px solid #e8e5e0;border-radius:12px;padding:28px;margin-bottom:24px;">
        <h3 style="font-size:1rem;font-weight:600;margin-bottom:16px;">
            <i class="bi bi-bag"></i> Detail Produk
        </h3>
        @foreach($pesanan->detailPesanan as $d)
        <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 0;border-bottom:1px solid #f0eeeb;">
            <div>
                <span style="font-weight:500;font-size:0.92rem;">{{ $d->produk->nama }}</span>
                <span style="color:#888;font-size:0.82rem;margin-left:6px;">× {{ $d->qty }}</span>
            </div>
            <span style="font-weight:500;font-size:0.92rem;">Rp {{ number_format($d->harga * $d->qty,0,',','.') }}</span>
        </div>
        @endforeach

        <div style="display:flex;justify-content:space-between;padding:18px 0 0;margin-top:4px;">
            <span style="font-weight:700;font-size:1.05rem;">Total</span>
            <span style="font-weight:700;font-size:1.05rem;color:#2e7d32;">Rp {{ number_format($pesanan->total,0,',','.') }}</span>
        </div>
    </div>

    <!-- Order Info -->
    <div style="background:#fff;border:1px solid #e8e5e0;border-radius:12px;padding:28px;">
        <h3 style="font-size:1rem;font-weight:600;margin-bottom:16px;">
            <i class="bi bi-info-circle"></i> Informasi Pesanan
        </h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;font-size:0.88rem;">
            <div>
                <span style="color:#888;">No. Pesanan</span>
                <p style="font-weight:500;margin:2px 0 0;">#{{ $pesanan->id }}</p>
            </div>
            <div>
                <span style="color:#888;">Tanggal Pesan</span>
                <p style="font-weight:500;margin:2px 0 0;">{{ $pesanan->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <span style="color:#888;">Metode Pembayaran</span>
                <p style="font-weight:500;margin:2px 0 0;">{{ $pesanan->metode_pembayaran ?? '-' }}</p>
            </div>
            <div>
                <span style="color:#888;">Status</span>
                <p style="font-weight:500;margin:2px 0 0;">{{ $statusLabels[$pesanan->status] ?? ucfirst($pesanan->status) }}</p>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @media (max-width: 576px) {
        div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush
@endsection
