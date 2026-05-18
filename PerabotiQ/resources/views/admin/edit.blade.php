<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Edit Produk - PerabotiQ</title>
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5" style="max-width: 600px;">
    <h2>Edit Produk: {{ $product->name }}</h2>
    <div class="card mt-4">
      <div class="card-body">
        <form action="{{ route('admin.update', $product->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
          </div>
          <div class="mb-3">
            <label>Kategori</label>
            <select name="category" class="form-select" required>
                <option value="Ruang Tamu" {{ $product->category == 'Ruang Tamu' ? 'selected' : '' }}>Ruang Tamu</option>
                <option value="Kamar Tidur" {{ $product->category == 'Kamar Tidur' ? 'selected' : '' }}>Kamar Tidur</option>
                <option value="Ruang Makan" {{ $product->category == 'Ruang Makan' ? 'selected' : '' }}>Ruang Makan</option>
                <option value="Ruang Kerja" {{ $product->category == 'Ruang Kerja' ? 'selected' : '' }}>Ruang Kerja</option>
                <option value="Kamar Mandi" {{ $product->category == 'Kamar Mandi' ? 'selected' : '' }}>Kamar Mandi</option>
                <option value="Aksesoris" {{ $product->category == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Harga (Rp)</label>
            <input type="number" name="price" class="form-control" value="{{ intval($product->price) }}" required>
          </div>
          <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
          </div>
          <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
          </div>
          <div class="mb-3">
            <label>Gambar Produk Baru (Opsional)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ route('admin.index') }}" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
