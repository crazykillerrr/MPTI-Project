<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tambah Produk - PerabotiQ</title>
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5" style="max-width: 600px;">
    <h2>Tambah Produk Baru</h2>
    <div class="card mt-4">
      <div class="card-body">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Kategori</label>
            <select name="category" class="form-select" required>
                <option value="Ruang Tamu">Ruang Tamu</option>
                <option value="Kamar Tidur">Kamar Tidur</option>
                <option value="Ruang Makan">Ruang Makan</option>
                <option value="Ruang Kerja">Ruang Kerja</option>
                <option value="Kamar Mandi">Kamar Mandi</option>
                <option value="Aksesoris">Aksesoris</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Harga (Rp)</label>
            <input type="number" name="price" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Stok Awal</label>
            <input type="number" name="stock" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label>Gambar Produk (Opsional)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="{{ route('admin.index') }}" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
