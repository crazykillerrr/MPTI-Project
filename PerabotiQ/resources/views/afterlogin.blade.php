<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PerabotiQ - Dashboard</title>

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
  <link href="/assets/css/rekomendasi.css" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      
            <a href="{{ route('customer.dashboard') }}" class="logo d-flex align-items-center">
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
                    <li><a href="#hero" class="active">Home</a></li>
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
                  <a href="{{ route('customer.profil') }}" style="color: #333;"><i class="bi bi-person-badge me-1"></i> Profil Saya</a>
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

      <!-- Hero Section -->
      <section id="hero" class="hero section dark-background">
        <div id="hero-carousel" data-bs-interval="5000" class="container-fluid carousel carousel-fade" data-bs-ride="carousel">
  
          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url(https://www.pixelstalk.net/wp-content/uploads/images1/Free-furniture-wallpapers.jpg);">
            <div class="carousel-container">
              <h2 class="animate__animated animate__fadeInDown" style="color: white;">Welcome to <span>PerabotiQ</span></h2>
              <p class="animate__animated animate__fadeInUp" style="color: white;">Quality furniture for every room</p>
            </div>
          </div>
  
          <!-- Slide 2 -->
          <div class="carousel-item" style="background-image: url('https://cdn.wallpapersafari.com/45/58/kQX2HB.jpg');">
            <div class="carousel-container">
              <h2 class="animate__animated animate__fadeInDown" style="color: black;">Dream Bedroom</h2>
              <p class="animate__animated animate__fadeInUp" style="color: black;">Comfortable and modern, find the best design inspiration for your bedroom.</p>
            </div>
          </div>
  
          <!-- Slide 3 -->
          <div class="carousel-item" style="background-image: url('https://wallpaperaccess.com/full/2076125.jpg');">
            <div class="carousel-container">
              <h2 class="animate__animated animate__fadeInDown" style="color: white;">Modern Minimalist Style</h2>
              <p class="animate__animated animate__fadeInUp" style="color: white;">Design the dining room with a minimalist and elegant touch.</p>
            </div>
          </div>
  
          <!-- Controls -->
          <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </a>
  
          <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </a>
  
        </div>
      
      </section><!-- /Hero Section -->
  
      <!-- About Section -->
      <section id="about" class="about section">
  
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>About</h2>
          <p>Who we are</p>
        </div><!-- End Section Title -->
  
        <div class="container">
  
          <div class="row gy-4">
  
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
              <p>
                PrabotiQ is a trusted e-commerce platform that offers a wide range of household furniture with modern designs and the best quality. We are here to help you create a comfortable and aesthetic living space.
              </p>
              <ul>
                <li><i class="bi bi-check2-circle"></i> <span>Quality products at competitive prices.</span></li>
                <li><i class="bi bi-check2-circle"></i> <span>Modern design and a variety of style choices.</span></li>
                <li><i class="bi bi-check2-circle"></i> <span>Fast and secure delivery service.</span></li>
              </ul>
            </div>
  
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
              <p>We are committed to providing an easy, fast, and satisfying shopping experience. Find furniture inspiration for every corner of your home only at PrabotiQ.</p>
            </div>
  
          </div>
  
        </div>
  
      </section><!-- /About Section -->
  
      <!-- Products Section -->
      <section id="products" class="products section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Product</h2>
          <p>Detail Product</p>
        </div><!-- End Section Title -->
  
        <div class="container">
          <div class="row gy-4">
  
            <!-- Product 1 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="product-item position-relative p-0 overflow-hidden">
                <a href="{{ route('produk.kategori.login', 'ruang-tamu') }}">
                  <img src="https://p4.wallpaperbetter.com/wallpaper/274/668/983/fabulous-living-room-living-room-set-wallpaper-preview.jpg" alt="Product 1" class="product-img">
                </a>
              </div>
              <p class="mt-2 fw-semibold text-left">Living Room</p>
            </div>
            
  
             <!-- Product 2 -->
             <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
              <div class="product-item position-relative p-0 overflow-hidden">
                <a href="{{ route('produk.kategori.login', 'ruang-tidur') }}">
                  <img src="https://4.bp.blogspot.com/-9DENORtzjAY/WSkxS07HpmI/AAAAAAAAAvk/ZDigDqEydZEu5Tj1Vb8g7QXOSykMvWxZQCLcB/s1600/Desain%2BKamar%2BTidur%2BUtama%2BMinimalis%2BUkuran%2B3x4.jpg" alt="Product 1" class="product-img">
                </a>
              </div>
              <p class="mt-2 fw-semibold text-left">Bedroom</p>
            </div>
  
            <!-- Product 3 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
              <div class="product-item position-relative p-0 overflow-hidden">
                <a href="{{ route('produk.kategori.login', 'ruang-makan') }}">
                  <img src="https://i.pinimg.com/originals/ee/89/74/ee8974954744d6347a404b45e10d35ea.png"  alt="Product 3" class="product-img">
                </a>
              </div>
              <p class="mt-2 fw-semibold text-left">Dining Room</p>
            </div>
  
            <!-- Product 4 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
              <div class="product-item position-relative p-0 overflow-hidden">
                <a href="{{ route('produk.kategori.login', 'ruang-kerja') }}">
                  <img src="https://d3p0bla3numw14.cloudfront.net/news-content/img/2021/08/02173644/Ruang-Kerja-Minimalis-di-Sudut-Ruangan.jpg" alt="Product 4" class="product-img">
                </a>
              </div>
              <p class="mt-2 fw-semibold text-left">Workspace</p>
            </div>
  
            <!-- Product 5 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
              <div class="product-item position-relative p-0 overflow-hidden">
                <a href="{{ route('produk.kategori.login', 'kamar-mandi') }}">
                  <img src="https://1.bp.blogspot.com/-BVaruwh-vG8/Vqm5qBicKaI/AAAAAAAAAVY/MOJVzOuYgI4/s1600/Interior%2BKamar%2BMandi.jpg" alt="Product 5" class="product-img">
                </a>
              </div>
              <p class="mt-2 fw-semibold text-left">Bathroom</p>
            </div>
  
            <!-- Product 6 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
              <div class="product-item position-relative p-0 overflow-hidden">
                <a href="{{ route('produk.kategori.login', 'aksesoris') }}">
                  <img src="https://ds393qgzrxwzn.cloudfront.net/cat1/img/images/0/USU5Nx4RlN.jpg" alt="Product 6" class="product-img">
                </a>
              </div>
              <p class="mt-2 fw-semibold text-left">Accessories</p>
            </div>
  
          </div>
        </div>
      </section>

      {{-- ══════════ Product Recommendations ══════════ --}}
      @include('partials._rekomendasi', [
        'produkRekomendasi' => $produkRekomendasi ?? collect(),
        'checkoutUrl'       => route('produk.kategori.login', 'ruang-tamu'),
        'isGuest'           => false,
      ])



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




