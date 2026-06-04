@extends('layouts.admin')
@section('title','Dashboard Admin')
@section('content')
<div class="page-header">
    <div>
        <h1>Dashboard</h1>
        <p>PerabotiQ store overview</p>
    </div>
</div>

<div class="card-grid">
    <div class="stat-card">
        <div class="card-top">
            <div class="label">Total Products</div>
            <div class="card-icon orange"><i class="bi bi-box-seam-fill"></i></div>
        </div>
        <div class="value">{{ $totalProduk }}</div>
    </div>
    <div class="stat-card">
        <div class="card-top">
            <div class="label">Total Orders</div>
            <div class="card-icon blue"><i class="bi bi-receipt"></i></div>
        </div>
        <div class="value">{{ $totalPesanan }}</div>
    </div>
    <div class="stat-card">
        <div class="card-top">
            <div class="label">Total Transactions</div>
            <div class="card-icon purple"><i class="bi bi-credit-card-fill"></i></div>
        </div>
        <div class="value">{{ $totalTransaksi }}</div>
    </div>
    <div class="stat-card">
        <div class="card-top">
            <div class="label">Revenue</div>
            <div class="card-icon green"><i class="bi bi-wallet2"></i></div>
        </div>
        <div class="value" style="font-size:1.3rem;">Rp{{ number_format($pendapatan,0,',','.') }}</div>
    </div>
</div>

<!-- Quick Actions -->
<div style="margin-top:10px;">
    <h2 style="font-size:1rem;font-weight:600;margin-bottom:16px;color:var(--text-secondary);">Quick Actions</h2>
    <div style="display:flex;gap:12px;flex-wrap:wrap;">
        <a href="{{ route('admin.produk.tambah') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Product
        </a>
        <a href="{{ route('admin.pesanan') }}" class="btn">
            <i class="bi bi-receipt"></i> View Orders
        </a>
        <a href="{{ route('admin.transaksi') }}" class="btn">
            <i class="bi bi-credit-card"></i> Manage Transactions
        </a>
        <a href="{{ route('admin.laporan') }}" class="btn">
            <i class="bi bi-bar-chart-line"></i> View Reports
        </a>
    </div>
</div>
@endsection
