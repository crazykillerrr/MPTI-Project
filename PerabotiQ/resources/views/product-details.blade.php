<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PerabotiQ - {{ $product->nama }}</title>

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

  {{-- ========== HEADER: GUEST (sebelum login) ========== --}}
  @guest
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      
      <a href="/" class="logo d-flex align-items-center">
        <h1 class="sitename">PerabotiQ</h1>
      </a>
  
      <!-- NAV TOGGLE -->
      <input type="checkbox" id="nav-toggle" class="nav-toggle d-xl-none">
      <label for="nav-toggle" class="mobile-nav-toggle d-xl-none">
        <i class="bi bi-list"></i>
      </label>
  
      <!-- NAV MENU -->
      <nav id="navmenu">
        <ul class="navmenu">
          <li><a href="/">Home</a></li>
          <li><a href="/#about">About</a></li>
          <li><a href="/#products">Products</a></li>
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
                <a href="/login">Sign in</a>
                <a href="/register">Create Account</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </header>
  @endguest

  {{-- ========== HEADER: CUSTOMER (setelah login) ========== --}}
  @auth
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
  
      <a href="/" class="logo d-flex align-items-center">
        <h1 class="sitename">PerabotiQ</h1>
      </a>

      <!-- NAV TOGGLE -->
      <input type="checkbox" id="nav-toggle" class="nav-toggle d-xl-none">
      <label for="nav-toggle" class="mobile-nav-toggle d-xl-none">
        <i class="bi bi-list"></i>
      </label>

      <!-- NAV MENU -->
      <nav id="navmenu">
        <ul class="navmenu">
          <li><a href="/">Home</a></li>
          <li><a href="/#about">About</a></li>
          <li><a href="/#products">Products</a></li>
        </ul>
      </nav>

      <!-- RIGHT BUTTONS (login version with circle icons + truck) -->
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
      
            <!-- Dropdown -->
            <div class="profile-dropdown" id="profileDropdown">
              <div class="arrow-up"></div>
              <div class="dropdown-content">
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
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </header>
  @endauth


  {{-- ========== MAIN CONTENT ========== --}}
  <main class="main">

    <div style="height: 100px;"></div>

    <!-- Page Title -->
    <div class="page-title dark-background">
      <div class="container position-relative">
      </div>
    </div>

    <!-- Product Details Section -->
    <section id="product-detail" class="product-detail section">
      <div class="container">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        <div class="row align-items-start">
    
          <!-- Gambar Produk -->
          <div class="col-lg-6" data-aos="fade-right">
            <img src="/{{ $product->gambar }}" alt="{{ $product->nama }}" class="img-fluid rounded shadow-sm">
          </div>
    
          <!-- Detail Produk -->
          <div class="col-lg-6 mt-4 mt-lg-0" data-aos="fade-left">
            <h2 class="fw-bold">{{ $product->nama }}</h2>
            <h5 class="text-muted mb-3">Kategori: {{ ucwords(str_replace('-', ' ', $product->kategori)) }}</h5>
    
            <p><strong>Product details :</strong></p>
            <p>
              {{ $product->deskripsi ?? 'Produk ini dirancang dengan kualitas terbaik untuk kenyamanan dan keindahan ruangan Anda. Dibuat dari material premium yang tahan lama dan mudah dirawat.' }}
            </p>
    
            <!-- Pilihan Warna -->
            <div class="mb-3">
              <label for="warna" class="form-label fw-semibold">Color</label>
              <select id="warna" class="form-select w-auto">
                <option selected>Default</option>
                <option>Grey</option>
                <option>Beige</option>
              </select>
            </div>
    
            <!-- Atur Jumlah -->
            <div class="mb-3 d-flex align-items-center gap-3">
              <label class="form-label fw-semibold mb-0">Quantity</label>
              <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle" onclick="kurangiJumlah()" style="width: 32px; height: 32px;">−</button>
              <span id="jumlah-display" class="px-2 fw-bold">1</span>
              <input type="hidden" id="jumlah-input" value="1">
              <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle" onclick="tambahJumlah()" style="width: 32px; height: 32px;">+</button>
            </div>
    
            <!-- Harga -->
            <p class="fw-semibold fs-5 mt-3">Total Price : <span id="subtotal">Rp{{ number_format($product->harga, 0, ',', '.') }}</span></p>

            <!-- Stok -->
            @if($product->stok > 0)
              <p class="text-success mb-2" style="font-size: 0.85rem;"><i class="bi bi-check-circle"></i> Stok Tersedia ({{ $product->stok }})</p>
            @else
              <p class="text-danger mb-2" style="font-size: 0.85rem;"><i class="bi bi-x-circle"></i> Stok Kosong</p>
            @endif

            {{-- Tombol: berbeda untuk guest vs customer --}}
            @auth
              <form action="{{ route('keranjang.tambah') }}" method="POST">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" id="qty-form" value="1">
                @if($product->stok > 0)
                  <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill" style="background-color: #C18888; border: none; font-size: 1.1rem;">
                    Add to cart
                  </button>
                @else
                  <button type="button" class="btn btn-secondary px-4 py-2 rounded-pill" disabled>Habis</button>
                @endif
              </form>
            @endauth
            @guest
              @if($product->stok > 0)
                <a href="/login" class="btn btn-primary px-4 py-2 rounded-pill" style="background-color: #C18888; border: none; font-size: 1.1rem; text-decoration: none;">
                  <i class="bi bi-box-arrow-in-right me-1"></i> Login untuk Membeli
                </a>
              @else
                <button type="button" class="btn btn-secondary px-4 py-2 rounded-pill" disabled>Habis</button>
              @endif
            @endguest

          </div>
        </div>
      </div>
    </section>

  </main>


  <!-- FOOTER -->
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

  <!-- Scripts -->
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/main.js"></script>
  <script>
    const hargaSatuan = {{ $product->harga }};
    const maxStock = {{ $product->stok }};
    let jumlah = 1;

    function formatRupiah(angka) {
      return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updateDisplay() {
      document.getElementById('jumlah-display').innerText = jumlah;
      const inputEl = document.getElementById('jumlah-input');
      if (inputEl) inputEl.value = jumlah;
      const qtyForm = document.getElementById('qty-form');
      if (qtyForm) qtyForm.value = jumlah;
      const total = hargaSatuan * jumlah;
      document.getElementById('subtotal').innerText = 'Rp' + formatRupiah(total);
    }

    function tambahJumlah() {
      if (jumlah < maxStock) { jumlah++; updateDisplay(); }
      else { alert('Jumlah melebihi stok yang tersedia!'); }
    }

    function kurangiJumlah() {
      if (jumlah > 1) { jumlah--; updateDisplay(); }
    }
  </script>
</body>
</html>
