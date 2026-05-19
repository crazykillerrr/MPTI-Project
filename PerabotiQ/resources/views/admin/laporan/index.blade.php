@extends('layouts.admin')
@section('title','Laporan Penjualan')
@section('content')
<h1>Laporan Penjualan</h1>
<div class="card-grid" style="grid-template-columns:repeat(2,1fr);max-width:500px;">
    <div class="card"><div class="label">Total Pendapatan</div><div class="value" style="font-size:1.2rem;">Rp.{{ number_format($pendapatan,0,',','.') }}</div></div>
    <div class="card"><div class="label">Total Item Terjual</div><div class="value">{{ $terjual }}</div></div>
</div>
<h2 style="font-size:1rem;font-weight:600;margin:24px 0 12px;">Pendapatan per Bulan</h2>
<table style="max-width:500px;">
    <thead><tr><th>Bulan</th><th>Pendapatan</th></tr></thead>
    <tbody>
        @forelse($perBulan as $b)
        <tr>
            <td>{{ DateTime::createFromFormat('!m', $b->bulan)->format('F') }}</td>
            <td>Rp.{{ number_format($b->total,0,',','.') }}</td>
        </tr>
        @empty
        <tr><td colspan="2" style="text-align:center;color:#aaa;padding:20px;">Belum ada data.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
