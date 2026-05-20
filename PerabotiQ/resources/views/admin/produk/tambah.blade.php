@extends('layouts.admin')
@section('title','Tambah Produk')
@section('content')
<div class="page-header">
    <div>
        <h1><i class="bi bi-plus-circle-fill" style="color:var(--accent);margin-right:8px;"></i>Tambah Produk</h1>
        <p>Tambahkan produk baru ke katalog toko</p>
    </div>
    <a href="{{ route('admin.produk') }}" class="btn">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="form-card">
    <form action="{{ route('admin.produk.simpan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label><i class="bi bi-tag-fill" style="color:var(--accent);margin-right:4px;"></i> Nama Produk</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Masukkan nama produk" required>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group">
                <label><i class="bi bi-cash-stack" style="color:var(--accent);margin-right:4px;"></i> Harga (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga') }}" class="form-control" placeholder="0" required>
            </div>
            <div class="form-group">
                <label><i class="bi bi-boxes" style="color:var(--accent);margin-right:4px;"></i> Stok</label>
                <input type="number" name="stok" value="{{ old('stok') }}" class="form-control" placeholder="0" required>
            </div>
        </div>

        <div class="form-group">
            <label><i class="bi bi-grid-fill" style="color:var(--accent);margin-right:4px;"></i> Kategori</label>
            <select name="kategori" class="form-control" required>
                @foreach(['aksesoris','kamar-mandi','ruang-kerja','ruang-makan','ruang-tamu','ruang-tidur'] as $k)
                    <option value="{{ $k }}" {{ old('kategori')==$k?'selected':'' }}>{{ ucfirst(str_replace('-',' ',$k)) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label><i class="bi bi-text-paragraph" style="color:var(--accent);margin-right:4px;"></i> Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsikan produk Anda...">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label><i class="bi bi-image-fill" style="color:var(--accent);margin-right:4px;"></i> Gambar Produk</label>
            <input type="file" name="gambar" accept="image/*" class="form-control form-file">
            <div class="form-hint">Format: JPG, PNG, WebP. Maksimal 2MB.</div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i> Simpan Produk
            </button>
            <a href="{{ route('admin.produk') }}" class="btn">Batal</a>
        </div>
    </form>
</div>
@endsection
