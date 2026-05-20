@extends('layouts.admin')
@section('title','Dashboard Admin')
@section('content')
<div class="page-header">
    <div>
        <h1>Dashboard</h1>
        <p>Ringkasan data toko PerabotiQ</p>
    </div>
</div>

<div class="card-grid">
    <div class="stat-card">
        <div class="card-top">
            <div class="label">Total Produk</div>
            <div class="card-icon orange"><i class="bi bi-box-seam-fill"></i></div>
        </div>
        <div class="value">{{ $totalProduk }}</div>
    </div>
    <div class="stat-card">
        <div class="card-top">
            <div class="label">Total Pesanan</div>
            <div class="card-icon blue"><i class="bi bi-receipt"></i></div>
        </div>
        <div class="value">{{ $totalPesanan }}</div>
    </div>
    <div class="stat-card">
        <div class="card-top">
            <div class="label">Total Transaksi</div>
            <div class="card-icon purple"><i class="bi bi-credit-card-fill"></i></div>
        </div>
        <div class="value">{{ $totalTransaksi }}</div>
    </div>
    <div class="stat-card">
        <div class="card-top">
            <div class="label">Pendapatan</div>
            <div class="card-icon green"><i class="bi bi-wallet2"></i></div>
        </div>
        <div class="value" style="font-size:1.3rem;">Rp{{ number_format($pendapatan,0,',','.') }}</div>
    </div>
</div>

<!-- Quick Actions -->
<div style="margin-top:10px;">
    <h2 style="font-size:1rem;font-weight:600;margin-bottom:16px;color:var(--text-secondary);">Aksi Cepat</h2>
    <div style="display:flex;gap:12px;flex-wrap:wrap;">
        <a href="{{ route('admin.produk.tambah') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Produk
        </a>
        <a href="{{ route('admin.pesanan') }}" class="btn">
            <i class="bi bi-receipt"></i> Lihat Pesanan
        </a>
        <a href="{{ route('admin.transaksi') }}" class="btn">
            <i class="bi bi-credit-card"></i> Kelola Transaksi
        </a>
        <a href="{{ route('admin.laporan') }}" class="btn">
            <i class="bi bi-bar-chart-line"></i> Lihat Laporan
        </a>
    </div>
</div>
@endsection
