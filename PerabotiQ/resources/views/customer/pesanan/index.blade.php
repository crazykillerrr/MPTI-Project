@extends('layouts.customer')
@section('title','Pesanan Saya — PerabotiQ')

@push('styles')
<style>
/* ── PAGE WRAPPER ── */
.pesanan-page {
    background: #EFEFEF;
    min-height: calc(100vh - 80px);
    padding: 10px 0 80px;
}

/* ── HEADER ── */
.pesanan-header {
    text-align: center;
    margin-bottom: 32px;
}
.pesanan-header h1 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 6px;
}
.pesanan-header p {
    font-size: 0.9rem;
    color: #888;
    margin: 0;
}

/* ── TAB FILTER ── */
.tab-filter-wrap {
    display: flex;
    gap: 0;
    flex-wrap: nowrap;
    overflow-x: auto;
    margin-bottom: 20px;
    background: #fff;
    border-radius: 12px;
    padding: 6px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
}
.tab-filter-wrap::-webkit-scrollbar { display: none; }

.tab-btn {
    padding: 9px 16px;
    font-size: 0.82rem;
    font-weight: 500;
    font-family: 'Poppins', sans-serif;
    border: none;
    background: transparent;
    color: #666;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
    position: relative;
}
.tab-btn:hover { color: #7a5c4e; background: #f5eeea; }
.tab-btn.active {
    background: #7a5c4e;
    color: #fff;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(122,92,78,0.3);
}

/* Badge count on tab */
.tab-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.35);
    color: inherit;
    font-size: 0.65rem;
    font-weight: 700;
    min-width: 18px;
    height: 18px;
    padding: 0 4px;
    border-radius: 20px;
    margin-left: 4px;
    vertical-align: middle;
}
.tab-btn:not(.active) .tab-count {
    background: #e8e2de;
    color: #7a5c4e;
}

/* ── SEARCH BAR ── */
.pesanan-search {
    position: relative;
    margin-bottom: 16px;
}
.pesanan-search input {
    width: 100%;
    padding: 11px 16px 11px 44px;
    border: 1.5px solid #e0dbd8;
    border-radius: 10px;
    font-size: 0.88rem;
    color: #1a1a1a;
    background: #fff;
    outline: none;
    transition: border-color 0.2s;
    font-family: 'Poppins', sans-serif;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
}
.pesanan-search input:focus { border-color: #7a5c4e; }
.pesanan-search .search-icon {
    position: absolute;
    left: 14px; top: 50%;
    transform: translateY(-50%);
    color: #aaa;
    font-size: 1rem;
    pointer-events: none;
}

/* ── PESANAN CARD ── */
.pesanan-card {
    background: #fff;
    border: 1px solid #e4e0dd;
    border-radius: 14px;
    margin-bottom: 12px;
    overflow: hidden;
    transition: box-shadow 0.22s, transform 0.15s;
}
.pesanan-card:hover {
    box-shadow: 0 6px 24px rgba(0,0,0,0.09);
    transform: translateY(-1px);
}

/* Card top (produk info) */
.card-top {
    padding: 16px 20px;
    border-bottom: 1px solid #f2efec;
    display: flex;
    align-items: center;
    gap: 14px;
}
.card-img {
    width: 76px;
    height: 76px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #ede9e5;
    flex-shrink: 0;
    background: #f9f7f5;
}
.card-product-info { flex: 1; min-width: 0; }
.card-product-name {
    font-weight: 700;
    font-size: 0.93rem;
    color: #1a1a1a;
    margin: 0 0 3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.card-product-meta {
    font-size: 0.79rem;
    color: #aaa;
    margin: 0 0 2px;
}
.card-product-qty {
    font-size: 0.79rem;
    color: #999;
    margin: 0;
}
.card-price {
    font-weight: 700;
    font-size: 0.95rem;
    color: #1a1a1a;
    white-space: nowrap;
    flex-shrink: 0;
    align-self: center;
}

/* Card bottom (total + aksi) */
.card-bottom {
    padding: 13px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}
.total-wrap { display: flex; flex-direction: column; gap: 4px; }
.total-label { font-size: 0.82rem; color: #888; }
.total-label span { font-weight: 700; color: #1a1a1a; }
.card-actions { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; }

/* Notice badges */
.notice-badge {
    font-size: 0.76rem;
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 6px;
    font-weight: 500;
}
.notice-warning { color: #e65100; background: #fff3e0; }
.notice-ship    { color: #1565c0; background: #e3f2fd; }
.notice-success { color: #2e7d32; background: #e8f5e9; }
.notice-danger  { color: #c62828; background: #fce4ec; }
.notice-info    { color: #555;    background: #f3f0ed; }

/* Buttons */
.btn-aksi {
    padding: 8px 16px;
    font-size: 0.81rem;
    font-weight: 600;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    transition: all 0.18s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    line-height: 1;
}
.btn-primary-cust {
    background: #7a5c4e;
    color: #fff;
}
.btn-primary-cust:hover {
    background: #5e4238;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 3px 10px rgba(122,92,78,0.3);
}
.btn-outline-cust {
    background: transparent;
    color: #7a5c4e;
    border: 1.5px solid #c8b4aa;
}
.btn-outline-cust:hover {
    background: #f5eeea;
    color: #7a5c4e;
}

/* ── EMPTY STATE ── */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: #fff;
    border-radius: 14px;
}
.empty-state svg { opacity: 0.25; margin-bottom: 16px; }
.empty-state h4 {
    font-size: 1rem;
    font-weight: 700;
    color: #444;
    margin: 0 0 8px;
}
.empty-state p {
    font-size: 0.85rem;
    color: #999;
    margin: 0 0 20px;
}
.btn-shop {
    display: inline-block;
    padding: 10px 28px;
    background: #7a5c4e;
    color: #fff;
    border-radius: 24px;
    font-size: 0.88rem;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s;
}
.btn-shop:hover { background: #5e4238; color: #fff; }

.d-none-custom { display: none !important; }

@media(max-width: 600px) {
    .tab-btn { padding: 8px 12px; font-size: 0.76rem; }
    .card-top { flex-wrap: wrap; }
    .card-price { width: 100%; text-align: right; }
    .card-bottom { flex-direction: column; align-items: flex-start; }
    .card-actions { width: 100%; justify-content: flex-end; }
}
</style>
@endpush

@section('content')

@php
    /*
     * Semua status yang ada di sistem:
     * menunggu_pembayaran  → To Pay
     * diproses             → To Ship
     * siap_kirim           → To Ship
     * dalam_pengiriman     → To Receive
     * terkirim             → Completed  (kurir mark delivered, menunggu konfirmasi user)
     * selesai              → Completed  (user konfirmasi terima)
     * gagal_kirim          → Return
     * dibatalkan           → Cancelled
     */
    $statusMap = [
        'menunggu_pembayaran' => 'to_pay',
        'diproses'            => 'to_ship',
        'siap_kirim'          => 'to_ship',
        'dalam_pengiriman'    => 'to_receive',
        'terkirim'            => 'completed',
        'selesai'             => 'completed',
        'gagal_kirim'         => 'return',
        'dibatalkan'          => 'cancelled',
    ];

    $tabs = [
        'all'        => 'Semua',
        'to_pay'     => 'To Pay',
        'to_ship'    => 'To Ship',
        'to_receive' => 'To Receive',
        'completed'  => 'Completed',
        'return'     => 'Return',
        'cancelled'  => 'Cancelled',
    ];

    // Count per tab
    $counts = ['all' => $pesanan->count()];
    foreach (array_keys($tabs) as $t) {
        if ($t === 'all') continue;
        $counts[$t] = $pesanan->filter(fn($p) => ($statusMap[$p->status] ?? '') === $t)->count();
    }

    $activeTab = 'all';
@endphp

<div class="pesanan-page">
<div class="container" style="max-width:840px;">

    {{-- ── PAGE HEADER ── --}}
    <div class="pesanan-header">
        <h1>Pesanan Saya</h1>
        <p>Lacak dan lihat riwayat pesanan Anda</p>
    </div>

    {{-- ── TABS ── --}}
    <div class="tab-filter-wrap" id="tabWrap">
        @foreach($tabs as $key => $label)
        <button
            class="tab-btn {{ $key === 'all' ? 'active' : '' }}"
            id="tab-{{ $key }}"
            onclick="switchTab('{{ $key }}')"
        >
            {{ $label }}
            @if(($counts[$key] ?? 0) > 0)
                <span class="tab-count">{{ $counts[$key] }}</span>
            @endif
        </button>
        @endforeach
    </div>

    {{-- ── SEARCH ── --}}
    <div class="pesanan-search">
        <i class="bi bi-search search-icon"></i>
        <input
            type="text"
            id="searchPesanan"
            placeholder="Cari nama produk, nomor pesanan..."
            oninput="applyFilter()"
        >
    </div>

    {{-- ── PESANAN LIST ── --}}
    <div id="pesananContainer">

    @forelse($pesanan as $p)
    @php
        $tabKey      = $statusMap[$p->status] ?? 'all';
        $firstDetail = $p->detailPesanan->first();
        $firstImg    = $firstDetail?->produk?->image ?? '';
        $firstNama   = $firstDetail?->produk?->nama ?? '-';
        $firstKat    = $firstDetail?->produk?->kategori ?? '';
        $firstQty    = $firstDetail?->qty ?? 1;
        $firstHarga  = $firstDetail ? ($firstDetail->harga * $firstDetail->qty) : 0;
        $extraCount  = $p->detailPesanan->count() - 1;

        $tglFmt  = $p->created_at->format('Ymd');
        $orderNo = 'PBQ/' . $tglFmt . '/MPL/' . str_pad($p->id, 10, '0', STR_PAD_LEFT);

        $deadline        = $p->created_at->addDay()->format('d-m-Y H:i');
        $confirmDeadline = $p->updated_at->addDays(14)->format('d-m-Y');

        // teks untuk pencarian JS
        $searchText = strtolower($firstNama . ' ' . $orderNo . ' ' . $p->id);
        foreach($p->detailPesanan as $d) {
            $searchText .= ' ' . strtolower($d->produk?->nama ?? '');
        }
    @endphp

    <div class="pesanan-card"
         data-tab="{{ $tabKey }}"
         data-search="{{ $searchText }}"
         id="card-{{ $p->id }}">

        {{-- TOP: Produk --}}
        <div class="card-top">
            <img
                src="{{ $firstImg ? asset($firstImg) : '' }}"
                alt="{{ $firstNama }}"
                class="card-img"
                onerror="this.onerror=null;this.src='https://placehold.co/76x76/f5f3f0/bbb?text=Foto'"
            >
            <div class="card-product-info">
                <p class="card-product-name">{{ strtoupper($firstNama) }}</p>
                @if($firstKat)
                <p class="card-product-meta">{{ ucfirst(str_replace('-',' ',$firstKat)) }}</p>
                @endif
                <p class="card-product-qty">x{{ $firstQty }}</p>
                @if($extraCount > 0)
                <p style="font-size:0.76rem;color:#bbb;margin:3px 0 0;">+{{ $extraCount }} produk lainnya</p>
                @endif
            </div>
            <span class="card-price">Rp.{{ number_format($firstHarga, 0, ',', '.') }}</span>
        </div>

        {{-- BOTTOM: Status notice + Total + Aksi --}}
        <div class="card-bottom">
            <div class="total-wrap">
                {{-- Status notice --}}
                @if($p->status === 'menunggu_pembayaran')
                <div class="notice-badge notice-warning mb-1">
                    <i class="bi bi-clock"></i>
                    Bayar sebelum {{ $deadline }} via {{ $p->metode_pembayaran ?? 'Bank' }}
                </div>
                @elseif(in_array($p->status, ['diproses','siap_kirim']))
                <div class="notice-badge notice-info mb-1">
                    <i class="bi bi-gear-fill"></i> Pesanan sedang diproses
                </div>
                @elseif($p->status === 'dalam_pengiriman')
                <div class="notice-badge notice-ship mb-1">
                    <i class="bi bi-truck"></i>
                    Konfirmasi penerimaan sebelum <u>{{ $confirmDeadline }}</u>
                </div>
                @elseif($p->status === 'terkirim')
                <div class="notice-badge notice-success mb-1">
                    <i class="bi bi-check2-circle"></i> Paket telah terkirim — konfirmasi penerimaan
                </div>
                @elseif($p->status === 'selesai')
                <div class="notice-badge notice-success mb-1">
                    <i class="bi bi-check-circle-fill"></i> Paket telah diterima
                </div>
                @elseif($p->status === 'gagal_kirim')
                <div class="notice-badge notice-danger mb-1">
                    <i class="bi bi-exclamation-triangle-fill"></i> Pengiriman gagal — proses pengembalian
                </div>
                @elseif($p->status === 'dibatalkan')
                <div class="notice-badge notice-danger mb-1">
                    <i class="bi bi-x-circle-fill"></i> Pesanan dibatalkan
                </div>
                @endif

                <div class="total-label">
                    Total Payment : <span>Rp.{{ number_format($p->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="card-actions">
                {{-- TO PAY --}}
                @if($p->status === 'menunggu_pembayaran')
                    <a href="{{ route('customer.pesanan.detail', $p->id) }}" class="btn-aksi btn-outline-cust">
                        Change Payment
                    </a>
                    @if($p->transaksi && $p->transaksi->snap_token)
                        <button type="button" class="btn-aksi btn-primary-cust" onclick="payWithMidtrans('{{ $p->transaksi->snap_token }}')">
                            <i class="bi bi-credit-card"></i> Pay
                        </button>
                    @else
                        <a href="{{ route('customer.pesanan.detail', $p->id) }}" class="btn-aksi btn-primary-cust">
                            <i class="bi bi-credit-card"></i> Pay
                        </a>
                    @endif

                {{-- TO SHIP --}}
                @elseif(in_array($p->status, ['diproses','siap_kirim']))
                    <a href="{{ route('customer.pesanan.detail', $p->id) }}" class="btn-aksi btn-outline-cust">
                        <i class="bi bi-eye"></i> Order Details
                    </a>

                {{-- TO RECEIVE (dalam pengiriman) --}}
                @elseif($p->status === 'dalam_pengiriman')
                    <a href="{{ route('customer.pesanan.detail', $p->id) }}" class="btn-aksi btn-outline-cust">
                        <i class="bi bi-eye"></i> Order Details
                    </a>
                    <button type="button" class="btn-aksi btn-primary-cust"
                            onclick="openKonfirmasiModal({{ $p->id }}, '{{ addslashes(strtoupper($firstNama)) }}')">
                        <i class="bi bi-check2-circle"></i> Order Received
                    </button>

                {{-- TERKIRIM (kurir sudah deliver, tunggu konfirmasi user) --}}
                @elseif($p->status === 'terkirim')
                    <a href="{{ route('customer.pesanan.detail', $p->id) }}" class="btn-aksi btn-outline-cust">
                        <i class="bi bi-eye"></i> Order Details
                    </a>
                    <button type="button" class="btn-aksi btn-primary-cust"
                            onclick="openKonfirmasiModal({{ $p->id }}, '{{ addslashes(strtoupper($firstNama)) }}')">
                        <i class="bi bi-check2-circle"></i> Order Received
                    </button>

                {{-- COMPLETED (selesai) --}}
                @elseif($p->status === 'selesai')
                    <a href="{{ route('customer.pesanan.detail', $p->id) }}" class="btn-aksi btn-outline-cust">
                        <i class="bi bi-eye"></i> Order Details
                    </a>
                    <a href="{{ route('customer.dashboard') }}" class="btn-aksi btn-primary-cust">
                        <i class="bi bi-bag-plus"></i> Buy Again
                    </a>

                {{-- RETURN / GAGAL --}}
                @elseif($p->status === 'gagal_kirim')
                    <a href="{{ route('customer.pesanan.detail', $p->id) }}" class="btn-aksi btn-outline-cust">
                        <i class="bi bi-eye"></i> Order Details
                    </a>

                {{-- CANCELLED --}}
                @elseif($p->status === 'dibatalkan')
                    <a href="{{ route('customer.pesanan.detail', $p->id) }}" class="btn-aksi btn-outline-cust">
                        <i class="bi bi-eye"></i> Order Details
                    </a>

                @else
                    <a href="{{ route('customer.pesanan.detail', $p->id) }}" class="btn-aksi btn-outline-cust">
                        <i class="bi bi-eye"></i> Lihat Detail
                    </a>
                @endif
            </div>
        </div>

    </div>
    @empty
    <div class="empty-state" id="emptyAll">
        <svg width="110" height="110" viewBox="0 0 24 24" fill="#7a5c4e">
            <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96C5 16.1 6.1 17 7.5 17H19v-2H7.83c-.13 0-.25-.11-.25-.25l.03-.12.9-1.63H17c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1 1 0 0 0 21.46 4H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
        </svg>
        <h4>Kamu belum pernah bertransaksi</h4>
        <p>Cari barang impianmu? Yuk, belanja sekarang!</p>
        <a href="{{ route('customer.dashboard') }}" class="btn-shop">Belanja Sekarang</a>
    </div>
    @endforelse

    </div>{{-- /pesananContainer --}}

    {{-- Empty filter message --}}
    <div class="empty-state d-none-custom" id="emptyFilter">
        <svg width="72" height="72" viewBox="0 0 24 24" fill="#c5aea4">
            <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
        </svg>
        <h4>Tidak ada pesanan di sini</h4>
        <p>Coba pilih tab status yang lain</p>
    </div>

</div>
</div>

{{-- ═══ MODAL KONFIRMASI PENERIMAAN ═══ --}}
<div id="modalKonfirmasi" style="
    display:none;
    position:fixed;inset:0;
    background:rgba(0,0,0,0.45);
    z-index:9999;
    align-items:center;
    justify-content:center;
    backdrop-filter:blur(3px);
    padding:20px;
">
    <div style="
        background:#fff;
        border-radius:18px;
        max-width:440px;
        width:100%;
        padding:32px 28px;
        box-shadow:0 20px 60px rgba(0,0,0,0.18);
        animation:slideUp 0.25s ease;
        text-align:center;
    ">
        {{-- Icon --}}
        <div style="
            width:72px;height:72px;
            background:#e8f5e9;
            border-radius:50%;
            display:flex;align-items:center;justify-content:center;
            margin:0 auto 20px;
        ">
            <svg width="36" height="36" fill="#2e7d32" viewBox="0 0 24 24">
                <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
            </svg>
        </div>

        <h3 style="font-family:'Poppins',sans-serif;font-size:1.1rem;font-weight:700;color:#1a1a1a;margin:0 0 8px;">
            Konfirmasi Penerimaan Pesanan
        </h3>
        <p style="font-size:0.85rem;color:#888;margin:0 0 6px;">
            Apakah kamu sudah menerima pesanan:
        </p>
        <p id="modalProdukNama" style="font-size:0.92rem;font-weight:700;color:#7a5c4e;margin:0 0 20px;">-</p>

        <div style="
            background:#fff8f5;
            border:1px solid #f5d5c5;
            border-radius:10px;
            padding:12px 16px;
            margin-bottom:24px;
            font-size:0.8rem;
            color:#7a4030;
            text-align:left;
            display:flex;gap:8px;align-items:flex-start;
        ">
            <i class="bi bi-exclamation-triangle-fill" style="flex-shrink:0;margin-top:1px;"></i>
            <span>Pastikan paket sudah kamu terima dengan baik. Konfirmasi tidak dapat dibatalkan setelah dikirim.</span>
        </div>

        {{-- Hidden form --}}
        <form id="formKonfirmasi" method="POST" action="">
            @csrf
            <div style="display:flex;gap:12px;">
                <button type="button"
                    onclick="closeKonfirmasiModal()"
                    style="
                        flex:1;padding:12px;
                        border:1.5px solid #ddd;
                        background:#fff;color:#666;
                        border-radius:10px;font-size:0.88rem;
                        font-weight:600;cursor:pointer;
                        font-family:'Poppins',sans-serif;
                        transition:all 0.15s;
                    "
                    onmouseover="this.style.background='#f5f5f5'"
                    onmouseout="this.style.background='#fff'">
                    Batal
                </button>
                <button type="submit"
                    style="
                        flex:1;padding:12px;
                        background:#2e7d32;color:#fff;
                        border:none;border-radius:10px;
                        font-size:0.88rem;font-weight:700;
                        cursor:pointer;
                        font-family:'Poppins',sans-serif;
                        transition:all 0.15s;
                        display:flex;align-items:center;justify-content:center;gap:6px;
                    "
                    onmouseover="this.style.background='#1b5e20'"
                    onmouseout="this.style.background='#2e7d32'">
                    <i class="bi bi-check2-circle"></i> Ya, Sudah Terima
                </button>
            </div>
        </form>
    </div>
</div>

<style>
@keyframes slideUp {
    from { opacity:0; transform:translateY(20px) scale(0.97); }
    to   { opacity:1; transform:translateY(0)   scale(1); }
}
</style>

@push('scripts')
<script>
let currentTab = 'all';

function switchTab(tab) {
    currentTab = tab;
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    const btn = document.getElementById('tab-' + tab);
    if (btn) btn.classList.add('active');
    document.getElementById('searchPesanan').value = '';
    applyFilter();
}

function applyFilter() {
    const query = document.getElementById('searchPesanan').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.pesanan-card');
    let visible = 0;

    cards.forEach(card => {
        const matchTab    = (currentTab === 'all') || (card.dataset.tab === currentTab);
        const matchSearch = !query || card.dataset.search.includes(query);
        const show        = matchTab && matchSearch;
        card.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    const emptyFilter = document.getElementById('emptyFilter');
    if (!emptyFilter) return;
    if (visible === 0 && cards.length > 0) {
        emptyFilter.classList.remove('d-none-custom');
    } else {
        emptyFilter.classList.add('d-none-custom');
    }
}

// ── MODAL KONFIRMASI ──
function openKonfirmasiModal(pesananId, namaProduk) {
    const modal  = document.getElementById('modalKonfirmasi');
    const form   = document.getElementById('formKonfirmasi');
    const label  = document.getElementById('modalProdukNama');

    // Set action URL
    form.action = '/pesanan/' + pesananId + '/konfirmasi-terima';
    label.textContent = namaProduk;

    // Show modal
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeKonfirmasiModal() {
    const modal = document.getElementById('modalKonfirmasi');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

// Close modal when clicking backdrop
document.getElementById('modalKonfirmasi').addEventListener('click', function(e) {
    if (e.target === this) closeKonfirmasiModal();
});

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeKonfirmasiModal();
});

document.addEventListener('DOMContentLoaded', () => {
    // Animate cards in
    document.querySelectorAll('.pesanan-card').forEach((card, i) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(14px)';
        card.style.transition = 'opacity 0.3s ease ' + (i * 55) + 'ms, transform 0.3s ease ' + (i * 55) + 'ms';
        requestAnimationFrame(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        });
    });

    // Auto-switch tab if coming from link with ?tab=
    const urlParams = new URLSearchParams(window.location.search);
    const tabParam  = urlParams.get('tab');
    if (tabParam) switchTab(tabParam);
});

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
