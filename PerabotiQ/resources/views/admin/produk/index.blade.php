@extends('layouts.admin')
@section('title','Manage Products')
@section('content')
<div class="page-header">
    <div>
        <h1><i class="bi bi-box-seam-fill" style="color:var(--accent);margin-right:8px;"></i>Manage Products</h1>
        <p>Manage your store product catalog</p>
    </div>
    <a href="{{ route('admin.produk.tambah') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add Product
    </a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th style="text-align:right;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produk as $p)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:12px;">
                        @if($p->gambar)
                            <img src="/{{ $p->image }}" alt="{{ $p->nama }}" style="width:44px;height:44px;border-radius:8px;object-fit:cover;border:1px solid var(--card-border);">
                        @else
                            <div style="width:44px;height:44px;border-radius:8px;background:var(--body-bg);display:flex;align-items:center;justify-content:center;color:var(--text-muted);font-size:1.1rem;">
                                <i class="bi bi-image"></i>
                            </div>
                        @endif
                        <span style="font-weight:500;">{{ $p->nama }}</span>
                    </div>
                </td>
                <td><span class="badge badge-neutral">{{ ucfirst(str_replace('-',' ',$p->kategori)) }}</span></td>
                <td style="font-weight:600;">Rp{{ number_format($p->harga,0,',','.') }}</td>
                <td>
                    @if($p->stok < 5)
                        <span class="badge badge-danger"><i class="bi bi-exclamation-triangle-fill"></i> {{ $p->stok }}</span>
                    @elseif($p->stok < 15)
                        <span class="badge badge-warning">{{ $p->stok }}</span>
                    @else
                        <span class="badge badge-success">{{ $p->stok }}</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    <div style="display:flex;gap:8px;justify-content:flex-end;">
                        <a href="{{ route('admin.produk.edit', $p->id) }}" class="btn btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.produk.hapus', $p->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash3"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <div class="empty-state">
                        <i class="bi bi-box-seam" style="display:block;"></i>
                        <p>No products found. <a href="{{ route('admin.produk.tambah') }}" style="color:var(--accent);font-weight:600;">Add your first product →</a></p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
