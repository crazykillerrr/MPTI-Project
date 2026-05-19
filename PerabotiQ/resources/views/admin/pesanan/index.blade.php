@extends('layouts.admin')
@section('title','Kelola Pesanan')
@section('content')
<h1>Kelola Pesanan</h1>
<table>
    <thead><tr><th>#</th><th>Customer</th><th>Total</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr></thead>
    <tbody>
        @forelse($pesanan as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->user->name }}</td>
            <td>Rp.{{ number_format($p->total,0,',','.') }}</td>
            <td><span style="padding:3px 10px;border-radius:12px;background:#f5f3f0;font-size:0.78rem;">{{ str_replace('_',' ',ucfirst($p->status)) }}</span></td>
            <td>{{ $p->created_at->format('d M Y') }}</td>
            <td><a href="{{ route('admin.pesanan.detail', $p->id) }}" class="btn">Detail</a></td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;color:#aaa;padding:30px;">Belum ada pesanan.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
