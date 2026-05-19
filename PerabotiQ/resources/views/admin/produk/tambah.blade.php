@extends('layouts.admin')
@section('title','Tambah Produk')
@section('content')
<h1>Tambah Produk</h1>
<form action="{{ route('admin.produk.simpan') }}" method="POST" enctype="multipart/form-data" style="background:#fff;padding:30px;border-radius:10px;border:1px solid #e8e5e0;max-width:600px;">
    @csrf
    @foreach([['nama','Nama Produk','text'],['harga','Harga','number'],['stok','Stok','number']] as [$name,$label,$type])
    <div style="margin-bottom:18px;">
        <label style="display:block;font-size:0.82rem;font-weight:600;margin-bottom:6px;">{{ $label }}</label>
        <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name) }}" style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:0.9rem;">
    </div>
    @endforeach
    <div style="margin-bottom:18px;">
        <label style="display:block;font-size:0.82rem;font-weight:600;margin-bottom:6px;">Kategori</label>
        <select name="kategori" style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:0.9rem;">
            @foreach(['aksesoris','kamar-mandi','ruang-kerja','ruang-makan','ruang-tamu','ruang-tidur'] as $k)
                <option value="{{ $k }}" {{ old('kategori')==$k?'selected':'' }}>{{ ucfirst(str_replace('-',' ',$k)) }}</option>
            @endforeach
        </select>
    </div>
    <div style="margin-bottom:18px;">
        <label style="display:block;font-size:0.82rem;font-weight:600;margin-bottom:6px;">Deskripsi</label>
        <textarea name="deskripsi" rows="4" style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:0.9rem;">{{ old('deskripsi') }}</textarea>
    </div>
    <div style="margin-bottom:24px;">
        <label style="display:block;font-size:0.82rem;font-weight:600;margin-bottom:6px;">Gambar</label>
        <input type="file" name="gambar" accept="image/*">
    </div>
    <button type="submit" class="btn">Simpan Produk</button>
    <a href="{{ route('admin.produk') }}" class="btn" style="margin-left:10px;">Batal</a>
</form>
@endsection
