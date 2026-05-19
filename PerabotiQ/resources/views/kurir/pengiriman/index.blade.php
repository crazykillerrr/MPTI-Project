@extends('layouts.kurir')
@section('title','Pengiriman Aktif')
@section('content')
<h1>Pengiriman Aktif</h1>
<table>
    <thead><tr><th>#</th><th>Customer</th><th>Total</th><th>Aksi</th></tr></thead>
    <tbody>
        @forelse($pesanan as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->user->name }}</td>
            <td>Rp.{{ number_format($p->total,0,',','.') }}</td>
            <td><a href="{{ route('kurir.pengiriman.detail', $p->id) }}" class="btn">Update Status</a></td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align:center;color:#aaa;padding:30px;">Tidak ada pengiriman aktif.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
