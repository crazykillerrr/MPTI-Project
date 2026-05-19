@extends('layouts.admin')
@section('title','Dashboard Admin')
@section('content')
<h1>Dashboard</h1>
<div class="card-grid">
    <div class="card"><div class="label">Total Produk</div><div class="value">{{ $totalProduk }}</div></div>
    <div class="card"><div class="label">Total Pesanan</div><div class="value">{{ $totalPesanan }}</div></div>
    <div class="card"><div class="label">Total Transaksi</div><div class="value">{{ $totalTransaksi }}</div></div>
    <div class="card"><div class="label">Pendapatan</div><div class="value">Rp.{{ number_format($pendapatan,0,',','.') }}</div></div>
</div>
@endsection
