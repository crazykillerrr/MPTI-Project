@extends('layouts.customer')
@section('title','Detail Pesanan — PerabotiQ')
@section('content')

@php
    $statusSteps = ['menunggu_pembayaran','diproses','dikirim','selesai'];
    $statusLabels = [
        'menunggu_pembayaran' => 'Menunggu Pembayaran',
        'diproses'            => 'Sedang Diproses',
        'dikirim'             => 'Sedang Dikirim',
        'selesai'             => 'Pesanan Selesai',
        'dibatalkan'          => 'Dibatalkan',
    ];
    $isCancelled    = $pesanan->status === 'dibatalkan';
    $currentStep    = array_search($pesanan->status, $statusSteps);
    if ($currentStep === false) $currentStep = -1;

    // Build a nice order number
    $tglFmt = $pesanan->created_at->format('Ymd');
    $orderNo = 'PBQ/' . $tglFmt . '/MPL/' . str_pad($pesanan->id, 10, '0', STR_PAD_LEFT);

    $user     = $pesanan->user;
    $subtotal = $pesanan->detailPesanan->sum(fn($d) => $d->harga * $d->qty);
    $ongkir   = $pesanan->total - $subtotal;
    if ($ongkir < 0) $ongkir = 0;

    $transaksi = $pesanan->transaksi;
@endphp

<div style="background:#f0f0f0;min-height:calc(100vh - 80px);padding:30px 20px 80px;">
<div style="max-width:820px;margin:0 auto;">

    {{-- Back link --}}
    <a href="{{ route('customer.pesanan') }}"
       style="font-size:0.84rem;color:#666;text-decoration:none;display:inline-flex;align-items:center;gap:6px;margin-bottom:20px;">
        &#8592; Kembali ke Pesanan Saya
    </a>

    {{-- Main Card --}}
    <div style="background:#fff;border:1px solid #ddd;border-radius:16px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.06);">

        {{-- ── HEADER ── --}}
        <div style="padding:24px 28px;border-bottom:1px solid #eee;display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:10px;">
            <div>
                <h2 style="font-size:1.15rem;font-weight:700;margin:0 0 4px;color:#1a1a1a;">Detail Pesanan</h2>
                <p style="font-size:0.8rem;color:#888;margin:0;">No. Pesanan {{ $orderNo }}</p>
            </div>
            <div style="text-align:right;">
                <p style="font-size:0.82rem;color:#888;margin:0;">Tanggal Pemesanan:</p>
                <p style="font-size:0.84rem;font-weight:600;color:#1a1a1a;margin:2px 0 0;">
                    {{ $pesanan->created_at->translatedFormat('d F Y, H:i') }} WIB
                </p>
            </div>
        </div>

        {{-- ── STATUS BANNER ── --}}
        @if($isCancelled)
        <div style="margin:16px 28px;padding:16px 20px;background:#fce4ec;border-radius:10px;display:flex;align-items:center;gap:14px;">
            <div style="width:40px;height:40px;background:#c62828;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
            </div>
            <div>
                <p style="font-weight:700;font-size:0.95rem;color:#c62828;margin:0;">Pesanan Dibatalkan</p>
                <p style="font-size:0.8rem;color:#888;margin:2px 0 0;">Pesanan ini telah dibatalkan</p>
            </div>
        </div>
        @elseif($pesanan->status === 'dikirim')
        <div style="margin:16px 28px;padding:16px 20px;background:#e3f2fd;border-radius:10px;display:flex;align-items:center;gap:14px;border:1px solid #90caf9;">
            <div style="width:40px;height:40px;background:#1565c0;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>
            </div>
            <div>
                <p style="font-weight:700;font-size:0.95rem;color:#1565c0;margin:0;">Order is being shipped</p>
                <p style="font-size:0.8rem;color:#888;margin:2px 0 0;">Estimated arrival on {{ $pesanan->updated_at->addDays(3)->format('F d, Y') }}</p>
            </div>
        </div>
        @elseif($pesanan->status === 'selesai')
        <div style="margin:16px 28px;padding:16px 20px;background:#e8f5e9;border-radius:10px;display:flex;align-items:center;gap:14px;border:1px solid #a5d6a7;">
            <div style="width:40px;height:40px;background:#2e7d32;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            </div>
            <div>
                <p style="font-weight:700;font-size:0.95rem;color:#2e7d32;margin:0;">Pesanan Selesai</p>
                <p style="font-size:0.8rem;color:#888;margin:2px 0 0;">Terima kasih telah berbelanja di PerabotiQ!</p>
            </div>
        </div>
        @else
        <div style="margin:16px 28px;padding:16px 20px;background:#fff8e1;border-radius:10px;display:flex;align-items:center;gap:14px;border:1px solid #ffe082;">
            <div style="width:40px;height:40px;background:#f57f17;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div>
                <p style="font-weight:700;font-size:0.95rem;color:#f57f17;margin:0;">{{ $statusLabels[$pesanan->status] ?? ucfirst($pesanan->status) }}</p>
                <p style="font-size:0.8rem;color:#888;margin:2px 0 0;">Pesanan sedang dalam proses</p>
            </div>
        </div>
        @endif

        {{-- ── ORDER INFORMATION ── --}}
        <div style="margin:0 28px 0;padding:20px 0;border-bottom:1px solid #eee;">
            <h3 style="font-size:0.92rem;font-weight:700;margin:0 0 16px;color:#1a1a1a;">Order Information</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0;">

                {{-- Left: Kurir --}}
                <div style="padding-right:24px;">
                    <p style="font-size:0.78rem;color:#888;margin:0 0 6px;">Kurir</p>
                    <p style="font-size:0.9rem;font-weight:600;color:#1a1a1a;margin:0 0 6px;">PBQ Express (Regular)</p>
                    @if($pesanan->kurir)
                    <p style="font-size:0.78rem;color:#888;margin:4px 0 0;">No Resi</p>
                    <p style="font-size:0.85rem;font-weight:500;color:#1a1a1a;margin:2px 0 0;font-family:monospace;letter-spacing:0.04em;">
                        {{ strtoupper(substr(md5($pesanan->id . 'pbq'), 0, 16)) }}
                    </p>
                    @endif
                </div>

                {{-- Right: Shipping Address --}}
                <div style="padding-left:24px;border-left:1px solid #f0eeeb;">
                    <p style="font-size:0.78rem;color:#888;margin:0 0 6px;">Shipping Address</p>
                    <p style="font-size:0.9rem;font-weight:600;color:#1a1a1a;margin:0 0 2px;">{{ $user->name }}</p>
                    @if($user->phone)
                    <p style="font-size:0.82rem;color:#666;margin:0 0 2px;">(+62) {{ ltrim($user->phone, '+62') }}</p>
                    @endif
                    <p style="font-size:0.82rem;color:#666;margin:0 0 2px;line-height:1.5;">
                        {{ $user->address ?: 'Alamat tidak tersedia' }}
                    </p>
                    @if($user->post_code)
                    <p style="font-size:0.82rem;color:#666;margin:0;">{{ $user->post_code }}</p>
                    @endif
                    <span style="display:inline-block;margin-top:6px;font-size:0.7rem;padding:2px 10px;background:#e8f5e9;color:#2e7d32;border-radius:20px;font-weight:600;">Rumah</span>
                </div>
            </div>
        </div>

        {{-- ── PRODUCTS ORDERED ── --}}
        <div style="margin:0 28px 0;padding:20px 0;border-bottom:1px solid #eee;">
            <h3 style="font-size:0.92rem;font-weight:700;margin:0 0 16px;color:#1a1a1a;">Products Ordered</h3>

            @foreach($pesanan->detailPesanan as $d)
            <div style="display:flex;align-items:center;gap:16px;padding:12px 0;border-bottom:1px solid #f5f5f5;">
                {{-- Product Image --}}
                <div style="flex-shrink:0;">
                    @if($d->produk->gambar)
                    <img src="{{ asset('storage/'.$d->produk->gambar) }}" alt="{{ $d->produk->nama }}"
                         style="width:72px;height:72px;object-fit:cover;border-radius:10px;border:1px solid #eee;">
                    @else
                    <div style="width:72px;height:72px;background:#f5f3f0;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                        <svg width="26" height="26" fill="#ccc" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 12l-4-5-3 3.86L9 13l-3 4h12l-2-2z"/></svg>
                    </div>
                    @endif
                </div>

                {{-- Product Info --}}
                <div style="flex:1;">
                    <p style="font-weight:600;font-size:0.92rem;color:#1a1a1a;margin:0 0 4px;">{{ $d->produk->nama }}</p>
                    @if($d->produk->kategori)
                    <p style="font-size:0.78rem;color:#aaa;margin:0 0 2px;text-transform:capitalize;">{{ ucfirst($d->produk->kategori) }}</p>
                    @endif
                    <p style="font-size:0.82rem;color:#888;margin:0;">{{ $d->qty }} x Rp.{{ number_format($d->harga,0,',','.') }}</p>
                </div>

                {{-- Price --}}
                <span style="font-weight:700;font-size:0.95rem;color:#1a1a1a;flex-shrink:0;">
                    Rp.{{ number_format($d->harga * $d->qty,0,',','.') }}
                </span>
            </div>
            @endforeach
        </div>

        {{-- ── PAYMENT INFORMATION ── --}}
        <div style="margin:0 28px;padding:20px 0 24px;">
            <h3 style="font-size:0.92rem;font-weight:700;margin:0 0 16px;color:#1a1a1a;">Payment Information</h3>

            <div style="display:flex;justify-content:space-between;font-size:0.84rem;color:#666;margin-bottom:8px;">
                <span>Total Products</span>
                <span style="font-weight:500;color:#1a1a1a;">Rp.{{ number_format($subtotal,0,',','.') }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.84rem;color:#666;margin-bottom:16px;">
                <span>Shipping Cost</span>
                <span style="font-weight:500;color:#1a1a1a;">Rp.{{ number_format($ongkir > 0 ? $ongkir : 100000,0,',','.') }}</span>
            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 0;border-top:1px solid #eee;border-bottom:1px solid #eee;margin-bottom:12px;">
                <span style="font-weight:700;font-size:1rem;color:#1a1a1a;">Total Payment</span>
                <span style="font-weight:700;font-size:1.05rem;color:#1a1a1a;">Rp.{{ number_format($pesanan->total,0,',','.') }}</span>
            </div>

            <p style="font-size:0.88rem;font-weight:600;color:#1a1a1a;margin:0 0 2px;">
                {{ $pesanan->metode_pembayaran ?? 'Belum dipilih' }}
            </p>
            @if($transaksi && $transaksi->status === 'sukses')
            <p style="font-size:0.78rem;color:#888;margin:0;">
                Payment successful on {{ $transaksi->updated_at->format('F d, Y, H:i') }} WIB
            </p>
            @elseif($pesanan->status === 'menunggu_pembayaran')
            <p style="font-size:0.78rem;color:#e65100;margin:0;">Menunggu konfirmasi pembayaran</p>
            @endif
        </div>

    </div>{{-- end main card --}}

</div>
</div>

@push('styles')
<style>
@media(max-width:600px){
    div[style*="grid-template-columns:1fr 1fr"]{
        grid-template-columns:1fr !important;
    }
    div[style*="padding-left:24px;border-left"]{
        padding-left:0 !important;
        border-left:none !important;
        padding-top:16px !important;
        border-top:1px solid #f0eeeb !important;
    }
    div[style*="justify-content:space-between;align-items:flex-start"]{
        flex-direction:column !important;
    }
}
</style>
@endpush
@endsection
