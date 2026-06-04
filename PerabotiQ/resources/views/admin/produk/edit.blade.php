@extends('layouts.admin')
@section('title','Edit Product')
@section('content')
<div class="page-header">
    <div>
        <h1><i class="bi bi-pencil-square" style="color:var(--accent);margin-right:8px;"></i>Edit Product</h1>
        <p>Update product information for <strong>{{ $produk->nama }}</strong></p>
    </div>
    <a href="{{ route('admin.produk') }}" class="btn">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="form-card">
    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-group">
            <label><i class="bi bi-tag-fill" style="color:var(--accent);margin-right:4px;"></i> Product Name</label>
            <input type="text" name="nama" value="{{ old('nama', $produk->nama) }}" class="form-control" required>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group">
                <label><i class="bi bi-cash-stack" style="color:var(--accent);margin-right:4px;"></i> Price (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label><i class="bi bi-boxes" style="color:var(--accent);margin-right:4px;"></i> Stock</label>
                <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label><i class="bi bi-grid-fill" style="color:var(--accent);margin-right:4px;"></i> Category</label>
            <select name="kategori" class="form-control" required>
                @foreach(['aksesoris','kamar-mandi','ruang-kerja','ruang-makan','ruang-tamu','ruang-tidur'] as $k)
                    <option value="{{ $k }}" {{ $produk->kategori==$k?'selected':'' }}>{{ ucfirst(str_replace('-',' ',$k)) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label><i class="bi bi-text-paragraph" style="color:var(--accent);margin-right:4px;"></i> Description</label>
            <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
        </div>

        <div class="form-group">
            <label><i class="bi bi-image-fill" style="color:var(--accent);margin-right:4px;"></i> New Product Image (optional)</label>
            @if($produk->gambar)
                <div style="margin-bottom:12px;padding:12px;background:var(--body-bg);border-radius:8px;display:inline-flex;align-items:center;gap:12px;">
                    <img src="/{{ $produk->image }}" alt="{{ $produk->nama }}" style="width:64px;height:64px;border-radius:8px;object-fit:cover;border:1px solid var(--card-border);">
                    <span style="font-size:0.82rem;color:var(--text-muted);">Current image</span>
                </div>
            @endif
            <input type="file" name="gambar" accept="image/*" class="form-control form-file">
            <div class="form-hint">Leave empty to keep the current image.</div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i> Update Product
            </button>
            <a href="{{ route('admin.produk') }}" class="btn">Cancel</a>
        </div>
    </form>
</div>
@endsection
