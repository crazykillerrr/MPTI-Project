<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Admin Dashboard - PerabotiQ</title>
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">PerabotiQ Admin</a>
      <div class="ms-auto d-flex">
        <a class="nav-link text-white me-3" href="/">Go to Homepage</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-light btn-sm" type="submit">Logout</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h2>Product Management (Stock & Items)</h2>
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="card shadow-sm mt-4">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Product Catalog</h5>
        <a href="{{ route('admin.create') }}" class="btn btn-primary btn-sm">Add Product</a>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Category</th>
              <th>Price</th>
              <th>Stock</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $p)
            <tr>
              <td>{{ $p->id }}</td>
              <td>
                @if($p->image)
                  <img src="/{{ $p->image }}" width="50" class="rounded">
                @else
                  - 
                @endif
              </td>
              <td>{{ $p->name }}</td>
              <td>{{ $p->category }}</td>
              <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
              <td>
                @if($p->stock < 5)
                  <span class="badge bg-danger">{{ $p->stock }}</span>
                @else
                  <span class="badge bg-success">{{ $p->stock }}</span>
                @endif
              </td>
              <td class="text-center">
                <a href="{{ route('admin.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this?');">
                  @csrf
                  <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
