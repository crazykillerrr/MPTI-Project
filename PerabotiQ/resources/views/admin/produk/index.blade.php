@extends('layouts.admin')
@section('title','Kelola Produk')
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <h1 style="margin-bottom:0;">Kelola Produk</h1>
    <a href="{{ route('admin.produk.tambah') }}" class="btn">+ Tambah Produk</a>
</div>
<table>
    <thead><tr><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
    <tbody>
        @forelse($produk as $p)
        <tr>
            <td>{{ $p->nama }}</td>
            <td>{{ ucfirst(str_replace('-',' ',$p->kategori)) }}</td>
            <td>Rp.{{ number_format($p->harga,0,',','.') }}</td>
            <td>{{ $p->stok }}</td>
            <td style="display:flex;gap:8px;">
                <a href="{{ route('admin.produk.edit', $p->id) }}" class="btn">Edit</a>
                <form action="{{ route('admin.produk.hapus', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;color:#aaa;padding:30px;">Belum ada produk.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
