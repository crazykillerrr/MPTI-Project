@extends('layouts.customer')
@section('title','Detail Pesanan — PerabotiQ')
@section('content')

@php
    /*
     * Status aktual sistem:
     * menunggu_pembayaran | diproses | siap_kirim
     * dalam_pengiriman | terkirim | selesai
     * gagal_kirim | dibatalkan
     */
    $statusLabels = [
        'menunggu_pembayaran' => 'Menunggu Pembayaran',
        'diproses'            => 'Sedang Diproses',
        'siap_kirim'          => 'Siap Dikirim',
        'dalam_pengiriman'    => 'Sedang Dikirim',
        'terkirim'            => 'Terkirim',
        'selesai'             => 'Pesanan Selesai',
        'gagal_kirim'         => 'Gagal Kirim',
        'dibatalkan'          => 'Dibatalkan',
    ];

    $isCancelled  = $pesanan->status === 'dibatalkan';
    $isGagal      = $pesanan->status === 'gagal_kirim';
    $isDikirim    = in_array($pesanan->status, ['dalam_pengiriman']);
    $isTerkirim   = $pesanan->status === 'terkirim';
    $isSelesai    = $pesanan->status === 'selesai';
    $isDiproses   = in_array($pesanan->status, ['diproses','siap_kirim']);

    // Build a nice order number
    $tglFmt  = $pesanan->created_at->format('Ymd');
    $orderNo = 'PBQ/' . $tglFmt . '/MPL/' . str_pad($pesanan->id, 10, '0', STR_PAD_LEFT);

    $user      = $pesanan->user;
    $subtotal  = $pesanan->detailPesanan->sum(fn($d) => $d->harga * $d->qty);
    $ongkir    = $pesanan->total - $subtotal;
    if ($ongkir < 0) $ongkir = 0;
    $transaksi = $pesanan->transaksi;
@endphp

<div style="background:#EFEFEF;min-height:calc(100vh - 80px);padding:30px 20px 80px;">
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

        {{-- DIBATALKAN --}}
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

        {{-- GAGAL KIRIM --}}
        @elseif($isGagal)
        <div style="margin:16px 28px;padding:16px 20px;background:#fce4ec;border-radius:10px;display:flex;align-items:center;gap:14px;border:1px solid #ef9a9a;">
            <div style="width:40px;height:40px;background:#e53935;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </div>
            <div>
                <p style="font-weight:700;font-size:0.95rem;color:#c62828;margin:0;">Pengiriman Gagal</p>
                <p style="font-size:0.8rem;color:#888;margin:2px 0 0;">Paket tidak dapat terkirim — tim kami akan menghubungi Anda</p>
            </div>
        </div>

        {{-- SELESAI --}}
        @elseif($isSelesai)
        <div style="margin:16px 28px;padding:16px 20px;background:#e8f5e9;border-radius:10px;display:flex;align-items:center;gap:14px;border:1px solid #a5d6a7;">
            <div style="width:40px;height:40px;background:#2e7d32;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            </div>
            <div>
                <p style="font-weight:700;font-size:0.95rem;color:#2e7d32;margin:0;">Pesanan Selesai</p>
                <p style="font-size:0.8rem;color:#888;margin:2px 0 0;">Terima kasih telah berbelanja di PerabotiQ!</p>
            </div>
        </div>

        {{-- TERKIRIM (kurir sudah antar, menunggu konfirmasi user) --}}
        @elseif($isTerkirim)
        <div style="margin:16px 28px;padding:16px 20px;background:#e8f5e9;border-radius:10px;display:flex;align-items:center;gap:14px;border:1px solid #a5d6a7;">
            <div style="width:40px;height:40px;background:#388e3c;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>
            </div>
            <div>
                <p style="font-weight:700;font-size:0.95rem;color:#2e7d32;margin:0;">Paket Telah Terkirim</p>
                <p style="font-size:0.8rem;color:#888;margin:2px 0 0;">Konfirmasi penerimaan sebelum {{ $pesanan->updated_at->addDays(14)->format('d-m-Y') }}</p>
            </div>
        </div>

        {{-- DALAM PENGIRIMAN --}}
        @elseif($isDikirim)
        <div style="margin:16px 28px;padding:16px 20px;background:#e3f2fd;border-radius:10px;display:flex;align-items:center;gap:14px;border:1px solid #90caf9;">
            <div style="width:40px;height:40px;background:#1565c0;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>
            </div>
            <div>
                <p style="font-weight:700;font-size:0.95rem;color:#1565c0;margin:0;">Order is being shipped</p>
                <p style="font-size:0.8rem;color:#888;margin:2px 0 0;">Estimated arrival on {{ $pesanan->updated_at->addDays(3)->format('F d, Y') }}</p>
            </div>
        </div>

        {{-- DIPROSES / SIAP KIRIM --}}
        @elseif($isDiproses)
        <div style="margin:16px 28px;padding:16px 20px;background:#e3f2fd;border-radius:10px;display:flex;align-items:center;gap:14px;border:1px solid #90caf9;">
            <div style="width:40px;height:40px;background:#0277bd;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
            </div>
            <div>
                <p style="font-weight:700;font-size:0.95rem;color:#0277bd;margin:0;">{{ $statusLabels[$pesanan->status] }}</p>
                <p style="font-size:0.8rem;color:#888;margin:2px 0 0;">Pesanan Anda sedang dipersiapkan</p>
            </div>
        </div>

        {{-- MENUNGGU PEMBAYARAN --}}
        @else
        <div style="margin:16px 28px;padding:16px 20px;background:#fff8e1;border-radius:10px;display:flex;align-items:center;gap:14px;border:1px solid #ffe082;">
            <div style="width:40px;height:40px;background:#f57f17;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
            </div>
            <div>
                <p style="font-weight:700;font-size:0.95rem;color:#f57f17;margin:0;">{{ $statusLabels[$pesanan->status] ?? ucfirst(str_replace('_',' ',$pesanan->status)) }}</p>
                <p style="font-size:0.8rem;color:#888;margin:2px 0 0;">Segera lakukan pembayaran sebelum pesanan dibatalkan</p>
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
                    <img src="{{ asset($d->produk->image) }}"
                         alt="{{ $d->produk->nama }}"
                         style="width:72px;height:72px;object-fit:cover;border-radius:10px;border:1px solid #eee;"
                         onerror="this.onerror=null;this.src='https://placehold.co/72x72/f5f3f0/aaa?text=Foto'">
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
            <p style="font-size:0.78rem;color:#e65100;margin:0 0 10px;">Menunggu konfirmasi pembayaran</p>
            @if($transaksi && $transaksi->snap_token)
                <button type="button" onclick="payWithMidtrans('{{ $transaksi->snap_token }}')" style="padding:10px 20px;background:#7a5c4e;color:#fff;border:none;border-radius:8px;font-size:0.86rem;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:6px;">
                    <i class="bi bi-credit-card"></i> Bayar Sekarang
                </button>
            @endif
            @endif
        </div>

        {{-- ── TOMBOL KONFIRMASI (hanya jika dalam_pengiriman atau terkirim) ── --}}
        @if(in_array($pesanan->status, ['dalam_pengiriman', 'terkirim']))
        <div style="padding:20px 28px;border-top:1px solid #f0eeeb;display:flex;justify-content:flex-end;gap:12px;flex-wrap:wrap;">
            <a href="{{ route('customer.pesanan') }}"
               style="padding:11px 22px;border:1.5px solid #ccc;border-radius:10px;font-size:0.86rem;font-weight:600;color:#666;text-decoration:none;font-family:'Poppins',sans-serif;transition:background 0.15s;"
               onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background=''">
                Kembali
            </a>
            <button type="button"
                onclick="document.getElementById('modalKonfirmasiDetail').style.display='flex';document.body.style.overflow='hidden';"
                style="padding:11px 22px;background:#2e7d32;color:#fff;border:none;border-radius:10px;font-size:0.86rem;font-weight:700;cursor:pointer;font-family:'Poppins',sans-serif;display:flex;align-items:center;gap:7px;transition:background 0.15s;"
                onmouseover="this.style.background='#1b5e20'" onmouseout="this.style.background='#2e7d32'">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                Konfirmasi Pesanan Diterima
            </button>
        </div>
        @endif

    </div>{{-- end main card --}}

</div>
</div>

{{-- ── MODAL KONFIRMASI (detail page) ── --}}
@if(in_array($pesanan->status, ['dalam_pengiriman', 'terkirim']))
<div id="modalKonfirmasiDetail" style="
    display:none;position:fixed;inset:0;
    background:rgba(0,0,0,0.45);z-index:9999;
    align-items:center;justify-content:center;
    backdrop-filter:blur(3px);padding:20px;
">
    <div style="
        background:#fff;border-radius:18px;
        max-width:440px;width:100%;
        padding:32px 28px;
        box-shadow:0 20px 60px rgba(0,0,0,0.18);
        animation:slideUpDetail 0.25s ease;
        text-align:center;
    ">
        {{-- Icon --}}
        <div style="width:72px;height:72px;background:#e8f5e9;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;">
            <svg width="36" height="36" fill="#2e7d32" viewBox="0 0 24 24">
                <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
            </svg>
        </div>

        <h3 style="font-family:'Poppins',sans-serif;font-size:1.1rem;font-weight:700;color:#1a1a1a;margin:0 0 8px;">
            Konfirmasi Penerimaan Pesanan
        </h3>
        <p style="font-size:0.84rem;color:#888;margin:0 0 6px;">Apakah kamu sudah menerima pesanan:</p>
        <p style="font-size:0.93rem;font-weight:700;color:#7a5c4e;margin:0 0 18px;">
            {{ strtoupper($pesanan->detailPesanan->first()?->produk?->nama ?? 'Pesanan #' . $pesanan->id) }}
            @if($pesanan->detailPesanan->count() > 1)
                <span style="font-size:0.78rem;color:#aaa;font-weight:500;">+{{ $pesanan->detailPesanan->count() - 1 }} lainnya</span>
            @endif
        </p>

        <div style="background:#fff8f5;border:1px solid #f5d5c5;border-radius:10px;padding:12px 16px;margin-bottom:24px;font-size:0.79rem;color:#7a4030;text-align:left;display:flex;gap:8px;align-items:flex-start;">
            <i class="bi bi-exclamation-triangle-fill" style="flex-shrink:0;margin-top:1px;"></i>
            <span>Pastikan paket sudah kamu terima dengan baik. Konfirmasi tidak dapat dibatalkan.</span>
        </div>

        <form method="POST" action="{{ route('customer.pesanan.konfirmasi', $pesanan->id) }}">
            @csrf
            <div style="display:flex;gap:12px;">
                <button type="button"
                    onclick="document.getElementById('modalKonfirmasiDetail').style.display='none';document.body.style.overflow='';"
                    style="flex:1;padding:12px;border:1.5px solid #ddd;background:#fff;color:#666;border-radius:10px;font-size:0.86rem;font-weight:600;cursor:pointer;font-family:'Poppins',sans-serif;"
                    onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#fff'">
                    Batal
                </button>
                <button type="submit"
                    style="flex:1;padding:12px;background:#2e7d32;color:#fff;border:none;border-radius:10px;font-size:0.86rem;font-weight:700;cursor:pointer;font-family:'Poppins',sans-serif;display:flex;align-items:center;justify-content:center;gap:6px;"
                    onmouseover="this.style.background='#1b5e20'" onmouseout="this.style.background='#2e7d32'">
                    <i class="bi bi-check2-circle"></i> Ya, Sudah Terima
                </button>
            </div>
        </form>
    </div>
</div>
@endif

@push('styles')
<style>
@keyframes slideUpDetail {
    from { opacity:0; transform:translateY(20px) scale(0.97); }
    to   { opacity:1; transform:translateY(0)    scale(1); }
}
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

@push('scripts')
<script>
// Close detail modal on backdrop click or Escape
@if(in_array($pesanan->status, ['dalam_pengiriman', 'terkirim']))
const detailModal = document.getElementById('modalKonfirmasiDetail');
if (detailModal) {
    detailModal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
            document.body.style.overflow = '';
        }
    });
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && detailModal) {
        detailModal.style.display = 'none';
        document.body.style.overflow = '';
    }
});
@endif

// Midtrans Snap Implementation
function payWithMidtrans(snapToken) {
    if (!snapToken) {
        alert('Token pembayaran tidak valid.');
        return;
    }
    window.snap.pay(snapToken, {
        onSuccess: function(result){
            alert("Pembayaran berhasil!");
            window.location.reload();
        },
        onPending: function(result){
            alert("Menunggu pembayaran Anda!");
            window.location.reload();
        },
        onError: function(result){
            alert("Pembayaran gagal!");
            window.location.reload();
        },
        onClose: function(){
            console.log('Customer closed the popup without finishing the payment');
        }
    });
}
</script>

<!-- Midtrans Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
@endpush

@endsection
