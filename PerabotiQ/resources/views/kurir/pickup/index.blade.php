@extends('layouts.kurir')
@section('title','Pickup Barang')
@section('content')
<h1>Daftar Pickup</h1>
<table>
    <thead><tr><th>#</th><th>Customer</th><th>Total</th><th>Tanggal</th><th>Aksi</th></tr></thead>
    <tbody>
        @forelse($pesanan as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->user->name }}</td>
            <td>Rp.{{ number_format($p->total,0,',','.') }}</td>
            <td>{{ $p->created_at->format('d M Y') }}</td>
            <td><a href="{{ route('kurir.pickup.detail', $p->id) }}" class="btn">Lihat Detail</a></td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;color:#aaa;padding:30px;">Tidak ada pesanan siap diambil.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
