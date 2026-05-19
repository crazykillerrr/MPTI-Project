<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PerabotiQ - Aksesoris</title>

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

<body class="product-details-page">

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
      <div class="search-container">
        <input type="text" id="searchInput" class="search-input" placeholder="Cari produk..." />

        <div class="d-flex gap-2 align-items-center">
          <button id="searchToggle" class="btn btn-outline-light" title="Search">
            <i class="bi bi-search"></i>
          </button>
        
  
          <!-- CART BUTTON -->
          <button class="btn btn-outline-light" onclick="window.location.href='/keranjang'" title="Cart">
            <i class="bi bi-cart"></i>
          </button>

          <!-- PROFILE DROPDOWN BUTTON -->
          <div class="profile-wrapper position-relative">
            <button class="btn btn-outline-light" title="Profile" onclick="toggleProfileDropdown()">
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

  <main class="main pt-5">
    <div style="height: 20px;"></div>
  
    <!-- Judul Halaman -->
    <div class="container mb-4">
      <h2 class="fw-bold">Aksesoris</h2>
    </div>
  
    <!-- Daftar Produk -->
        <div class="container">
      @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      
      <div class="row g-4">
        @if(isset($products))
          @forelse($products as $p)
          <div class="col-6 col-md-4 col-lg-3">
            <div class="card shadow-sm product-card h-100">
              <a href="{{ route('produk.detail', $p->id) }}"><img src="/{{ $p->image }}" class="card-img-top" alt="{{ $p->name }}" style="height: 200px; object-fit: cover; cursor: pointer;"></a>
              <div class="card-body d-flex flex-column">
                <a href="{{ route('produk.detail', $p->id) }}" style="text-decoration: none; color: inherit; cursor: pointer;"><h6 class="fw-bold mb-1">{{ $p->name }}</h6></a>
                <p class="mb-1 text-muted">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
                                @if($p->stock > 0)
                  <p class="mb-2 text-success" style="font-size: 0.85rem; font-weight: 500;"><i class="bi bi-check-circle"></i> Stok Tersedia ({{ $p->stock }})</p>
                @else
                  <p class="mb-2 text-danger" style="font-size: 0.85rem; font-weight: 500;"><i class="bi bi-x-circle"></i> Stok Kosong</p>
                @endif
                <form action="{{ route('keranjang.tambah') }}" method="POST" class="mt-auto">
                  @csrf
                  <input type="hidden" name="produk_id" value="{{ $p->id }}">
                  <input type="hidden" name="quantity" value="1">
                  @if($p->stock > 0)
                    <button type="submit" class="btn btn-outline-primary btn-sm w-100"><i class="bi bi-cart-plus"></i> Keranjang</button>
                  @else
                    <button type="button" class="btn btn-secondary btn-sm w-100" disabled>Habis</button>
                  @endif
                </form>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center py-5">
              <p class="text-muted">Belum ada produk di kategori ini.</p>
          </div>
          @endforelse
        @else
          <div class="col-12 text-center py-5">
              <p class="text-muted">Silakan pilih kategori dari halaman utama.</p>
          </div>
        @endif
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










