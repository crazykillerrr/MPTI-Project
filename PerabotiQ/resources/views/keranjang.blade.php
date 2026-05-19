<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PerabotiQ - Keranjang</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

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
  
      <!-- RIGHT BUTTONS (login style) -->
      <div class="d-flex gap-3 align-items-center">
        <div class="search-container d-flex align-items-center position-relative">
          <input type="text" id="searchInput" class="search-input" placeholder="Cari produk..." />
          <button id="searchToggle" class="icon-btn circle-icon" title="Search">
            <i class="bi bi-search"></i>
          </button>
      
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
      
            <div class="profile-dropdown" id="profileDropdown">
              <div class="arrow-up"></div>
              <div class="dropdown-content">
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

    </div>
  </header><main class="main">
    <div class="container py-5 mt-5">
        <h2 class="fw-bold mb-4">Keranjang Belanja</h2>
        
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
  
        <div class="row gx-4">
          <!-- COL: Items -->
          <div class="col-lg-8">
            @if(isset($cartItems) && $cartItems->count() > 0)
              <div id="cart-items">
                @php $totalPrice = 0; $totalItems = 0; @endphp
                @foreach($cartItems as $item)
                  @php 
                    $subtotal = $item->product->price * $item->quantity;
                    $totalPrice += $subtotal;
                    $totalItems += $item->quantity;
                  @endphp
                  <div class="card mb-3 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                      <img src="/{{ $item->product->image }}" alt="{{ $item->product->name }}" class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">
                      <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">{{ $item->product->name }}</h6>
                        <p class="text-muted mb-0">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        <small class="text-muted">Kategori: {{ $item->product->category }}</small>
                      </div>
                      <div class="d-flex flex-column align-items-end">
                        <span class="fw-bold mb-2">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        <div class="d-flex align-items-center">
                          <span class="me-3">Qty: {{ $item->quantity }}</span>
                          <form action="{{ route('keranjang.hapus') }}" method="POST">
                            @csrf
                            <input type="hidden" name="keranjang_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus produk ini dari keranjang?');"><i class="bi bi-trash"></i></button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <!-- Empty Cart Message -->
              <div class="empty-cart text-center py-5 bg-light rounded shadow-sm">
                <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
                <h4 class="fw-bold mt-3">Wah, keranjangmu kosong!</h4>
                <p>Yuk, cari produk favoritmu dulu~</p>
                <a href="/#products" class="btn btn-primary mt-3">Lihat Katalog</a>
              </div>
            @endif
          </div>
  
          <!-- COL: Summary -->
          <div class="col-lg-4">
            <div class="cart-summary p-4 bg-light rounded shadow-sm">
              <h4 class="mb-3">Ringkasan Belanja</h4>
              <p>Subtotal (<span id="item-count">{{ isset($totalItems) ? $totalItems : 0 }}</span> produk)</p>
              <h5 class="fw-bold mb-4">Rp<span id="total-price">{{ isset($totalPrice) ? number_format($totalPrice, 0, ',', '.') : 0 }}</span></h5>
              
              <a href="{{ route('checkout') }}" class="btn btn-primary w-100" {{ (!isset($cartItems) || $cartItems->count() == 0) ? 'style=pointer-events:none;opacity:0.5' : '' }}>Lanjut ke Pembayaran</a>
            </div>
          </div>
        </div>
    </div>
  </main>

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
  
    <hr>
  
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
          <li><a href="#">Careers</a></li>
          <li><a href="#">Responsible Design</a></li>
          <li><a href="#">Accessibility</a></li>
        </ul>
      </div>
      <div class="column">
        <h5>Follow Us</h5>
        <a href="#">#CrateStyle</a> | <a href="#">#CrateKidsStyle</a><br>
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

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="/assets/js/main.js"></script>
</body>

</html>





