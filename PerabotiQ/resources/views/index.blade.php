<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PerabotiQ - Homepage</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #F8F7F5;
      color: #333;
    }

    /* Header Overrides for Homepage */
    #header {
      background-color: rgba(148, 139, 128, 0.95) !important;
      padding: 15px 0;
    }

    #header .logo .sitename {
      color: #fff;
      font-weight: 700;
      margin: 0;
      font-size: 24px;
    }

    #header .navmenu {
      flex: 1;
      display: flex;
      justify-content: center;
    }

    #header .navmenu ul {
      margin: 0;
      padding: 0;
      display: flex;
      list-style: none;
      gap: 40px;
    }

    #header .navmenu a {
      color: #fff;
      font-weight: 500;
      font-size: 16px;
      text-decoration: none;
    }

    #header .navmenu a.active,
    #header .navmenu a:hover {
      color: #fff;
      font-weight: 700;
    }

    #header .btn-outline-light {
      border: none;
      font-size: 20px;
      color: #fff;
    }

    #header .btn-outline-light:hover {
      color: #ddd;
      background: none;
    }

    /* Hero */
    .hero-carousel {
      margin-top: 70px;
    }

    .hero-carousel .carousel-inner {
      height: 65vh;
      min-height: 400px;
    }

    .hero-carousel .carousel-item {
      height: 100%;
      background-size: cover;
      background-position: center;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: rgba(0, 0, 0, 0.3);
      border-radius: 50%;
      padding: 20px;
    }

    /* Sections */
    .custom-section {
      padding: 60px 0;
    }

    .section-title {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 30px;
      color: #000;
    }

    /* Category Grid */
    .cat-card {
      display: block;
      text-decoration: none;
      color: #333;
      text-align: center;
      margin-bottom: 20px;
      transition: transform 0.3s;
    }

    .cat-card:hover {
      transform: translateY(-5px);
      color: #000;
    }

    .cat-img-wrapper {
      border-radius: 12px;
      overflow: hidden;
      margin-bottom: 12px;
      height: 180px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    .cat-img-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s;
    }

    .cat-card:hover .cat-img-wrapper img {
      transform: scale(1.05);
    }

    .cat-title {
      font-size: 15px;
      font-weight: 500;
    }

    /* Asymmetric Grid */
    .rec-left {
      position: relative;
      border-radius: 16px;
      overflow: hidden;
      height: 100%;
      min-height: 450px;
    }

    .rec-left img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .hotspot {
      position: absolute;
      width: 16px;
      height: 16px;
      background: #fff;
      border-radius: 50%;
      box-shadow: 0 0 0 rgba(255, 255, 255, 0.4);
      animation: pulse 2s infinite;
      cursor: pointer;
    }

    .hotspot-1 {
      top: 35%;
      left: 30%;
    }

    .hotspot-2 {
      bottom: 35%;
      left: 60%;
    }

    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
      }

      70% {
        box-shadow: 0 0 0 15px rgba(255, 255, 255, 0);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
      }
    }

    .rec-card {
      background: #E4E0D9;
      border-radius: 16px;
      overflow: hidden;
      display: block;
      text-decoration: none;
      color: #333;
      margin-bottom: 24px;
      transition: transform 0.3s;
    }

    .rec-card:hover {
      transform: translateY(-5px);
    }

    .rec-card img {
      width: 100%;
      height: 260px;
      object-fit: cover;
    }

    .rec-card-body {
      padding: 15px 20px;
    }

    .rec-price {
      font-size: 20px;
      font-weight: 700;
      margin: 0 0 5px;
      color: #000;
    }

    .rec-name {
      font-size: 14px;
      color: #555;
      margin: 0;
    }

    /* Footer */
    .custom-footer {
      background-color: #F8F7F5;
      padding: 50px 0 20px;
      border-top: 1px solid #EBEAE7;
      font-size: 12px;
    }

    .custom-footer h4 {
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #000;
    }

    .custom-footer h5 {
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 12px;
      color: #000;
    }

    .custom-footer p {
      color: #555;
      margin-bottom: 5px;
    }

    .custom-footer a {
      color: #555;
      text-decoration: none;
    }

    .custom-footer a:hover {
      color: #000;
      text-decoration: underline;
    }

    .custom-footer ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .custom-footer ul li {
      margin-bottom: 6px;
    }

    .custom-footer .social-icons i {
      font-size: 16px;
      margin-right: 10px;
      color: #000;
    }

    .custom-footer .brands span {
      font-weight: 700;
      font-size: 11px;
      margin-right: 10px;
    }
  </style>
</head>

<body>

  <!-- HEADER -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center">

      <a href="/" class="logo me-auto text-decoration-none">
        <h1 class="sitename">PerabotiQ</h1>
      </a>

      <nav id="navmenu" class="navmenu mx-auto">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#products">Products</a></li>
        </ul>
      </nav>

      <div class="search-container ms-auto d-flex gap-3 align-items-center">
        <!-- Optional search input -->
        <!-- <input type="text" id="searchInput" class="search-input" placeholder="Cari produk..." style="display:none;" /> -->

        <button id="searchToggle" class="btn btn-outline-light p-1" title="Search">
          <i class="bi bi-truck"></i>
        </button>

        <!-- CART BUTTON -->
        <button class="btn btn-outline-light p-1" onclick="window.location.href='/keranjang'" title="Cart">
          <i class="bi bi-cart"></i>
        </button>

        <!-- PROFILE DROPDOWN BUTTON -->
        <div class="profile-wrapper position-relative">
          <button class="btn btn-outline-light p-1" title="Profile" onclick="toggleProfileDropdown()">
            <i class="bi bi-person"></i>
          </button>

          <!-- Dropdown -->
          <div class="profile-dropdown" id="profileDropdown" style="right:0;">
            <div class="arrow-up"></div>
            <div class="dropdown-content">
              @guest
                <a href="/login">Sign in</a>
                <a href="/register">Create Account</a>
              @endguest
              @auth
                <a href="#" style="font-weight: bold; pointer-events: none; color: #d66428;">Hi,
                  {{ explode(' ', Auth::user()->name)[0] }}</a>
                @if(Auth::user()->role === 'admin')
                  <a href="{{ route('admin.index') }}" style="color: #0d6efd; font-weight: 500;">Dashboard Admin</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0;">
                  @csrf
                  <button type="submit"
                    style="background: none; border: none; width: 100%; text-align: left; padding: 10px 16px; cursor: pointer; color: #333; font-size: 14px;">Logout</button>
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
    <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active"
          style="background-image: url('https://www.pixelstalk.net/wp-content/uploads/images1/Free-furniture-wallpapers.jpg');">
        </div>
        <div class="carousel-item" style="background-image: url('https://cdn.wallpapersafari.com/45/58/kQX2HB.jpg');">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- Product Selection -->
    <section id="products" class="custom-section container">
      <h2 class="section-title">Product Selection</h2>
      <div class="row">
        <div class="col-md-4 col-sm-6">
          <a href="/ruang-tamu" class="cat-card">
            <div class="cat-img-wrapper"><img
                src="https://p4.wallpaperbetter.com/wallpaper/274/668/983/fabulous-living-room-living-room-set-wallpaper-preview.jpg"
                alt="Sitting Room"></div>
            <div class="cat-title">Sitting Room</div>
          </a>
        </div>
        <div class="col-md-4 col-sm-6">
          <a href="/ruang-tidur" class="cat-card">
            <div class="cat-img-wrapper"><img
                src="https://4.bp.blogspot.com/-9DENORtzjAY/WSkxS07HpmI/AAAAAAAAAvk/ZDigDqEydZEu5Tj1Vb8g7QXOSykMvWxZQCLcB/s1600/Desain%2BKamar%2BTidur%2BUtama%2BMinimalis%2BUkuran%2B3x4.jpg"
                alt="Bedroom"></div>
            <div class="cat-title">Bedroom</div>
          </a>
        </div>
        <div class="col-md-4 col-sm-6">
          <a href="/ruang-makan" class="cat-card">
            <div class="cat-img-wrapper"><img
                src="https://i.pinimg.com/originals/ee/89/74/ee8974954744d6347a404b45e10d35ea.png" alt="Dining Room">
            </div>
            <div class="cat-title">Dining Room</div>
          </a>
        </div>
        <div class="col-md-4 col-sm-6">
          <a href="/ruang-kerja" class="cat-card">
            <div class="cat-img-wrapper"><img
                src="https://d3p0bla3numw14.cloudfront.net/news-content/img/2021/08/02173644/Ruang-Kerja-Minimalis-di-Sudut-Ruangan.jpg"
                alt="Workspace"></div>
            <div class="cat-title">Workspace</div>
          </a>
        </div>
        <div class="col-md-4 col-sm-6">
          <a href="/kamar-mandi" class="cat-card">
            <div class="cat-img-wrapper"><img
                src="https://1.bp.blogspot.com/-BVaruwh-vG8/Vqm5qBicKaI/AAAAAAAAAVY/MOJVzOuYgI4/s1600/Interior%2BKamar%2BMandi.jpg"
                alt="Bathroom"></div>
            <div class="cat-title">Bathroom</div>
          </a>
        </div>
        <div class="col-md-4 col-sm-6">
          <a href="/aksesoris" class="cat-card">
            <div class="cat-img-wrapper"><img
                src="https://ds393qgzrxwzn.cloudfront.net/cat1/img/images/0/USU5Nx4RlN.jpg" alt="Accessories"></div>
            <div class="cat-title">Accessories</div>
          </a>
        </div>
      </div>
    </section>

    <!-- Product Recommendations -->
    <section class="custom-section container pt-0">
      <h2 class="section-title">Product Recomendations</h2>
      <div class="row g-4">
        <div class="col-lg-8">
          <div class="rec-left">
            <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7" alt="Room Inspiration">
            <div class="hotspot hotspot-1"></div>
            <div class="hotspot hotspot-2"></div>
          </div>
        </div>
        <div class="col-lg-4">
          <a href="#" class="rec-card">
            <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc" alt="Kimmy Meja Putih">
            <div class="rec-card-body">
              <p class="rec-price">Rp.799.000</p>
              <p class="rec-name">Kimmy Meja Putih</p>
            </div>
          </a>
          <a href="#" class="rec-card">
            <img src="https://images.unsplash.com/photo-1513519245088-0e12902e5a38" alt="Hiasan Dinding Canvas">
            <div class="rec-card-body">
              <p class="rec-price">Rp.249.000</p>
              <p class="rec-name">Hiasan Dinding Canvas</p>
            </div>
          </a>
        </div>
      </div>
    </section>
  </main>

  <!-- Custom Footer -->
  <footer class="custom-footer">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-3">
          <h4><i class="bi bi-box-seam"></i> Orders</h4>
          <p>Find out when your purchase will arrive or schedule a delivery.</p>
          <p><a href="#">Track Order</a> | <a href="#">Schedule Delivery</a></p>
        </div>
        <div class="col-md-3">
          <h4><i class="bi bi-chat-dots"></i> Contact Us & Store Locator</h4>
          <p>Questions? Text us: (312) 779-1979</p>
          <p><a href="#">Chat With Us</a> | <a href="#">Leave Feedback</a> | <a href="#">Find a store</a></p>
        </div>
        <div class="col-md-3">
          <h4><i class="bi bi-credit-card"></i> Credit Card</h4>
          <p>Earn Reward Dollars every time you shop*</p>
          <p><a href="#">Apply Now</a> | <a href="#">Manage Your Account</a></p>
        </div>
        <div class="col-md-3">
          <h4><i class="bi bi-phone"></i> Our iOS App</h4>
          <p>Scan to shop exclusive first looks, get alerts & manage registry easier.</p>
          <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="App Store"
            style="height: 30px; margin-top: 5px;">
        </div>
      </div>
      <hr style="border-color: #EBEAE7;">
      <div class="row pt-3 pb-3">
        <div class="col-md-3">
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
        <div class="col-md-3">
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
        <div class="col-md-3">
          <h5>Our Company</h5>
          <ul>
            <li><a href="#">About Us</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5>Follow Us</h5>
          <p><a href="#">#CrateStyleYourHome</a></p>
          <div class="social-icons mb-3">
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
            <br><span>HUDSON</span>
            <span>GRACE</span>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center gap-3 pt-3" style="color:#d5a98a;">
        <a href="#" style="color:#d5a98a;">Terms of Use</a>
        <a href="#" style="color:#d5a98a;">Privacy</a>
        <a href="#" style="color:#d5a98a;">Site Index</a>
        <a href="#" style="color:#d5a98a;">Ad Choices</a>
        <a href="#" style="color:#d5a98a;">Cookie Settings</a>
        <a href="#" style="color:#d5a98a;">CA Supply Chains Act</a>
        <a href="#" style="color:#d5a98a;">Do Not Sell My Info</a>
      </div>
      <div class="text-center mt-3" style="color: #888;">
        &copy;2026 All rights reserved.
      </div>
    </div>
  </footer>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>