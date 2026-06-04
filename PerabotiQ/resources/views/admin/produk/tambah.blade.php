@extends('layouts.admin')
@section('title','Add Product')
@section('content')
<div class="page-header">
    <div>
        <h1><i class="bi bi-plus-circle-fill" style="color:var(--accent);margin-right:8px;"></i>Add Product</h1>
        <p>Add a new product to the store catalog</p>
    </div>
    <a href="{{ route('admin.produk') }}" class="btn">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="form-card">
    <form action="{{ route('admin.produk.simpan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label><i class="bi bi-tag-fill" style="color:var(--accent);margin-right:4px;"></i> Product Name</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Enter product name" required>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group">
                <label><i class="bi bi-cash-stack" style="color:var(--accent);margin-right:4px;"></i> Price (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga') }}" class="form-control" placeholder="0" required>
            </div>
            <div class="form-group">
                <label><i class="bi bi-boxes" style="color:var(--accent);margin-right:4px;"></i> Stock</label>
                <input type="number" name="stok" value="{{ old('stok') }}" class="form-control" placeholder="0" required>
            </div>
        </div>

        <div class="form-group">
            <label><i class="bi bi-grid-fill" style="color:var(--accent);margin-right:4px;"></i> Category</label>
            <select name="kategori" class="form-control" required>
                @foreach(['aksesoris','kamar-mandi','ruang-kerja','ruang-makan','ruang-tamu','ruang-tidur'] as $k)
                    <option value="{{ $k }}" {{ old('kategori')==$k?'selected':'' }}>{{ ucfirst(str_replace('-',' ',$k)) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label><i class="bi bi-text-paragraph" style="color:var(--accent);margin-right:4px;"></i> Description</label>
            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Describe your product...">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label><i class="bi bi-image-fill" style="color:var(--accent);margin-right:4px;"></i> Product Image</label>
            <input type="file" name="gambar" accept="image/*" class="form-control form-file">
            <div class="form-hint">Format: JPG, PNG, WebP. Max 2MB.</div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i> Save Product
            </button>
            <a href="{{ route('admin.produk') }}" class="btn">Cancel</a>
        </div>
    </form>
</div>
@endsection
