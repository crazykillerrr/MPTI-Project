<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'PerabotiQ')</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/animate.css/animate.min.css" rel="stylesheet">

  <!-- Main CSS -->
  <link href="/assets/css/main.css" rel="stylesheet">

  @stack('styles')
</head>

<body class="index-page">

  <!-- ═══════════════ HEADER ═══════════════ -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{ route('customer.dashboard') }}" class="logo d-flex align-items-center">
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
          <li><a href="{{ route('customer.dashboard') }}">Home</a></li>
          <li><a href="{{ route('customer.dashboard') }}#about">About</a></li>
          <li><a href="{{ route('customer.dashboard') }}#products">Products</a></li>
        </ul>
      </nav>

      <!-- RIGHT BUTTONS -->
      <div class="d-flex gap-3 align-items-center">
        <div class="search-container d-flex align-items-center position-relative">
          <input type="text" id="searchInput" class="search-input" placeholder="Search products..." />

          <!-- Search -->
          <button id="searchToggle" class="icon-btn circle-icon" title="Search">
            <i class="bi bi-search"></i>
          </button>

          <!-- Pesanan -->
          <button class="icon-btn circle-icon" onclick="window.location.href='{{ route('customer.pesanan') }}'" title="My Orders">
            <i class="bi bi-truck"></i>
          </button>

          <!-- Cart -->
          <button class="btn btn-outline-light" onclick="window.location.href='{{ route('keranjang') }}'" title="Cart">
            <i class="bi bi-cart"></i>
          </button>

          <!-- PROFILE DROPDOWN -->
          <div class="profile-wrapper position-relative">
            <button class="icon-btn circle-icon" title="Profile" onclick="toggleProfileDropdown()">
              <i class="bi bi-person-circle"></i>
            </button>

            <div class="profile-dropdown" id="profileDropdown">
              <div class="arrow-up"></div>
              <div class="dropdown-content">
                @guest
                  <a href="/login">Sign in</a>
                  <a href="/register">Create Account</a>
                @endguest
                @auth
                  <a href="#" style="font-weight:bold;pointer-events:none;color:#d66428;">
                    Hi, {{ explode(' ', Auth::user()->name)[0] }}
                  </a>
                  @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" style="color:#0d6efd;font-weight:500;">Dashboard Admin</a>
                  @endif
                  @if(Auth::user()->role === 'customer')
                    <a href="{{ route('customer.profil') }}" style="color:#333;">
                      <i class="bi bi-person-badge me-1"></i> My Profile
                    </a>
                    <a href="{{ route('customer.pesanan') }}" style="color:#333;">
                      <i class="bi bi-box-seam me-1"></i> My Orders
                    </a>
                    <a href="{{ route('keranjang') }}" style="color:#333;">
                      <i class="bi bi-cart3 me-1"></i> Cart
                    </a>
                  @endif
                  <form action="{{ route('logout') }}" method="POST" style="margin:0;padding:0;">
                    @csrf
                    <button type="submit" style="background:none;border:none;width:100%;text-align:left;padding:10px 16px;cursor:pointer;color:#333;font-size:14px;">
                      <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                  </form>
                @endauth
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </header>
  <!-- ═══════════════ /HEADER ═══════════════ -->

  <!-- Alerts -->
  @if(session('success'))
    <div style="margin-top:80px;padding:10px 30px;">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    </div>
  @endif
  @if(session('error'))
    <div style="margin-top:80px;padding:10px 30px;">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    </div>
  @endif

  <!-- MAIN CONTENT -->
  <main class="main" style="padding-top:80px;">
    @yield('content')
  </main>
  <!-- /MAIN CONTENT -->

  <!-- ═══════════════ FOOTER ═══════════════ -->
  <footer class="footer">
    <div class="footer-top">
      <div class="footer-section">
        <h4><i class="bi bi-box-seam"></i> Orders</h4>
        <p>Find out when your purchase will arrive or schedule a delivery.</p>
        <a href="#">Track Order</a> | <a href="#">Schedule Delivery</a>
      </div>
      <div class="footer-section">
        <h4><i class="bi bi-chat-dots"></i> Contact Us &amp; Store Locator</h4>
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
        <p>Scan to shop exclusive first looks, get alerts &amp; manage registry easier.</p>
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
          <li><a href="#">Email &amp; Text Preferences</a></li>
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
          <span>Crate&amp;Barrel</span>
          <span>Crate&amp;kids</span>
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
  <!-- ═══════════════ /FOOTER ═══════════════ -->

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS -->
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Main JS -->
  <script src="/assets/js/main.js"></script>

  @stack('scripts')
</body>
</html>
