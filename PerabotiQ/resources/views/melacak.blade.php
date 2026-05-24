<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PerabotiQ - Pesanan Saya</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/animate.css/animate.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="/assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      
            <a href="/" class="logo d-flex align-items-center">
                <h1 class="sitename">PerabotiQ</h1>
            </a>
  
            <!-- NAV TOGGLE - Checkbox Hack -->
            <input type="checkbox" id="nav-toggle" class="nav-toggle d-xl-none">
            <label for="nav-toggle" class="mobile-nav-toggle d-xl-none">
                <i class="bi bi-list"></i>
            </label>
  
            <!-- NAV MENU -->
            <nav id="navmenu">
                <ul class="navmenu">
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#products">Products</a></li>
                </ul>
            </nav>
  
            <!-- RIGHT BUTTONS -->
            <div class="d-flex gap-3 align-items-center">
              <div class="search-container d-flex align-items-center position-relative">
                <input type="text" id="searchInput" class="search-input" placeholder="Cari produk..." />
                <!-- Tombol Search -->
                <button id="searchToggle" class="icon-btn circle-icon" title="Search">
                  <i class="bi bi-search"></i>
                </button>
              
                <!-- Input Search ke kiri -->
            
                <!-- Delivery Icon -->
                <button class="icon-btn circle-icon" onclick="window.location.href='{{ route('customer.pesanan') }}'" title="Pesanan Saya">
                  <i class="bi bi-truck"></i>
                </button>
            
                <!-- CART BUTTON -->
          <button class="btn btn-outline-light" onclick="window.location.href='/keranjang'" title="Cart">
            <i class="bi bi-cart"></i>
          </button>

          <!-- PROFILE DROPDOWN BUTTON -->
                <div class="profile-wrapper position-relative">
                  <button class="icon-btn circle-icon" title="Profile" onclick="toggleProfileDropdown()">
                    <i class="bi bi-person-circle"></i>
                  </button>
            
                  <!-- Dropdown -->
                  <div class="profile-dropdown" id="profileDropdown">
                    <div class="arrow-up"></div>
                                                <div class="dropdown-content">
                @guest
                  <a href="/login">Sign in</a>
                  <a href="/register">Create Account</a>
                @endguest
                @auth
                  <a href="#" style="font-weight: bold; pointer-events: none; color: #d66428;">Hi, {{ explode(' ', Auth::user()->name)[0] }}</a>
                  @if(Auth::user()->role === 'admin')
                  <a href="{{ route('admin.dashboard') }}" style="color: #0d6efd; font-weight: 500;">Dashboard Admin</a>
                  @endif
                  @if(Auth::user()->role === 'customer')
                  <a href="{{ route('customer.pesanan') }}" style="color: #333;"><i class="bi bi-box-seam me-1"></i> Pesanan Saya</a>
                  <a href="{{ route('keranjang') }}" style="color: #333;"><i class="bi bi-cart3 me-1"></i> Keranjang</a>
                  @endif
                  <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0;">
                    @csrf
                    <button type="submit" style="background: none; border: none; width: 100%; text-align: left; padding: 10px 16px; cursor: pointer; color: #333; font-size: 14px;">Logout</button>
                  </form>
                @endauth
              </div>
                  </div>
                </div>
              </div>
            </div>
            
            
     </header>
  

 <main class="main">
  <div class="container py-5" style="margin-top: 60px;">
    <h2 class="fw-bold text-center mb-2">Pesanan Saya</h2>
    <p class="text-center text-muted mb-4">Lacak dan lihat riwayat pesanan Anda</p>

    <!-- Filter Buttons -->
    <div class="filter-container d-flex justify-content-center flex-wrap gap-2 mb-4">
      <button class="filter-btn active" data-status="all" onclick="filterPesanan(this, 'all')">Semua</button>
      <button class="filter-btn" data-status="menunggu_pembayaran" onclick="filterPesanan(this, 'menunggu_pembayaran')">Menunggu Pembayaran</button>
      <button class="filter-btn" data-status="diproses" onclick="filterPesanan(this, 'diproses')">Diproses</button>
      <button class="filter-btn" data-status="dikirim" onclick="filterPesanan(this, 'dikirim')">Dikirim</button>
      <button class="filter-btn" data-status="selesai" onclick="filterPesanan(this, 'selesai')">Selesai</button>
      <button class="filter-btn" data-status="dibatalkan" onclick="filterPesanan(this, 'dibatalkan')">Dibatalkan</button>
    </div>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div id="pesanan-list">
    @forelse($pesanan as $p)
    @php
      $statusColor = match($p->status) {
        'menunggu_pembayaran' => 'warning',
        'diproses' => 'info',
        'dikirim' => 'primary',
        'selesai' => 'success',
        'dibatalkan' => 'danger',
        default => 'secondary',
      };
      $statusLabel = match($p->status) {
        'menunggu_pembayaran' => 'Menunggu Pembayaran',
        'diproses' => 'Sedang Diproses',
        'dikirim' => 'Sedang Dikirim',
        'selesai' => 'Selesai',
        'dibatalkan' => 'Dibatalkan',
        default => str_replace('_',' ',ucfirst($p->status)),
      };
    @endphp
    <div class="card shadow-sm mb-3 pesanan-card" data-status="{{ $p->status }}">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-2">
          <div>
            <h6 class="fw-bold mb-1"><i class="bi bi-receipt me-1"></i> Pesanan #{{ $p->id }}</h6>
            <p class="text-muted mb-0" style="font-size:0.85rem;">
              <i class="bi bi-calendar3 me-1"></i>{{ $p->created_at->format('d M Y, H:i') }}
            </p>
          </div>
          <span class="badge bg-{{ $statusColor }} rounded-pill px-3 py-2">{{ $statusLabel }}</span>
        </div>

        <hr class="my-2" style="opacity: 0.15;">

        <div class="d-flex justify-content-between align-items-center">
          <div>
            <small class="text-muted">{{ $p->detailPesanan->count() }} produk</small>
            @if($p->metode_pembayaran)
            <small class="text-muted ms-2">• {{ $p->metode_pembayaran }}</small>
            @endif
          </div>
          <div class="text-end">
            <span class="fw-bold" style="font-size: 1.05rem;">Rp {{ number_format($p->total,0,',','.') }}</span>
          </div>
        </div>

        <div class="mt-3 d-flex gap-2 justify-content-end">
          <a href="{{ route('customer.pesanan.detail', $p->id) }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">
            <i class="bi bi-eye me-1"></i> Lihat Detail
          </a>
          @if($p->status === 'dikirim')
          <a href="{{ route('customer.pesanan.detail', $p->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-geo-alt me-1"></i> Lacak Pesanan
          </a>
          @endif
        </div>
      </div>
    </div>
    @empty
    <div class="text-center py-5" id="empty-state">
      <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
      <h4 class="fw-bold mt-3">Belum ada pesanan</h4>
      <p class="text-muted mb-4">Yuk, mulai belanja dan temukan produk impianmu!</p>
      <a href="{{ route('customer.dashboard') }}" class="btn btn-dark rounded-pill px-4 py-2">Mulai Belanja</a>
    </div>
    @endforelse
    </div>

    <!-- Empty filter state (hidden by default) -->
    <div class="text-center py-5 d-none" id="empty-filter-state">
      <i class="bi bi-funnel" style="font-size: 3rem; color: #ccc;"></i>
      <h5 class="fw-bold mt-3">Tidak ada pesanan dengan status ini</h5>
      <p class="text-muted">Coba pilih filter status yang lain</p>
    </div>
  </div>
</main>

<script>
function filterPesanan(btn, status) {
  // Update active button
  document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  const cards = document.querySelectorAll('.pesanan-card');
  const emptyFilter = document.getElementById('empty-filter-state');
  const emptyState = document.getElementById('empty-state');
  let visibleCount = 0;

  cards.forEach(card => {
    if (status === 'all' || card.dataset.status === status) {
      card.style.display = '';
      visibleCount++;
    } else {
      card.style.display = 'none';
    }
  });

  // Show/hide empty filter message
  if (visibleCount === 0 && cards.length > 0) {
    emptyFilter.classList.remove('d-none');
  } else {
    emptyFilter.classList.add('d-none');
  }
}
</script>


  
      <footer class="footer">
        <div class="footer-top">
          <div class="footer-section">
            <h4><i class="bi bi-box-seam"></i> Orders</h4>
            <p>Find out when your purchase will arrive or schedule a delivery.</p>
            <a href="#">Track Order</a> | <a href="#">Schedule Delivery</a>
          </div>
          <div class="footer-section">
            <h4><i class="bi bi-chat-dots"></i> Contact Us & Store Locator</h4>
            <p>Questions? Text us: <a href="tel:+13127791979">(312) 779-1979</a></p>
            <a href="#">Chat With Us</a> | <a href="#">Leave Feedback</a> | <a href="#">Find a Store</a>
          </div>
          <div class="footer-section">
            <h4><i class="bi bi-credit-card"></i> Credit Card</h4>
            <p>Earn Reward Dollars every time you shop*</p>
            <a href="#">Apply Now</a> | <a href="#">Manage Your Account</a>
          </div>
          <div class="footer-section">
            <h4><i class="bi bi-phone"></i> Our iOS App</h4>
            <p>Scan to shop exclusive first looks, get alerts & manage registry easier.</p>
            <img src="https://upload.wikimedia.org/wikipedia/commons/8/8d/Qr-1.png" alt="QR Code" class="qr-code">
            <br>
            <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="App Store" class="app-store">
          </div>
        </div>
      
        <div class="footer-links">
          <div class="column">
            <h5>Help</h5>
            <ul>
              <li><a href="#">Customer Service</a></li>
              <li><a href="#">Account</a></li>
              <li><a href="#">Return Policy</a></li>
              <li><a href="#">Shipping Info</a></li>
              <li><a href="#">Product Recalls</a></li>
              <li><a href="#">Email & Text Preferences</a></li>
              <li><a href="#">Sign Up for Texts</a></li>
            </ul>
          </div>
          <div class="column">
            <h5>Resources</h5>
            <ul>
              <li><a href="#">Free Design Services</a></li>
              <li><a href="#">Wedding Registry</a></li>
              <li><a href="#">Baby Registry</a></li>
              <li><a href="#">Gift Cards</a></li>
              <li><a href="#">Catalogs</a></li>
              <li><a href="#">Trade Program</a></li>
              <li><a href="#">Contract Grade Furniture</a></li>
            </ul>
          </div>
          <div class="column">
            <h5>Our Company</h5>
            <ul>
              <li><a href="#">About Us</a></li>
            </ul>
          </div>
          <div class="column">
            <h5>Follow Us</h5>
            <a href="#">#CrateStyleYourHome</a> 
            <div class="social-icons">
              <i class="bi bi-instagram"></i>
              <i class="bi bi-tiktok"></i>
              <i class="bi bi-pinterest"></i>
              <i class="bi bi-youtube"></i>
              <i class="bi bi-facebook"></i>
            </div>
            <h5>Our Brands</h5>
            <div class="brands">
              <span>Crate&Barrel</span>
              <span>Crate&kids</span>
              <span>CB2</span>
              <span>HUDSON</span>
              <span>GRACE</span>
            </div>
          </div>
        </div>
      
        <hr>
      
        <div class="footer-bottom">
          <div class="legal-links">
            <a href="#">Terms of Use</a>
            <a href="#">Privacy</a>
            <a href="#">Site Index</a>
            <a href="#">Ad Choices</a>
            <a href="#">Cookie Settings</a>
            <a href="#">CA Supply Chains Act</a>
            <a href="#">Do Not Sell My Info</a>
          </div>
          <p>&copy;2025 All rights reserved.</p>
        </div>
      </footer>
    

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="/assets/js/main.js"></script>

</body>

</html>




