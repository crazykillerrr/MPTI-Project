<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ $product->name }} - PerabotiQ</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  
</head>

<body>

  <!-- HEADER -->
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
                  <a href="{{ route('admin.index') }}" style="color: #0d6efd; font-weight: 500;">Dashboard Admin</a>
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
  </header><main style="padding: 60px 0;">
    <div class="container">
      @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <div class="row align-items-start gx-5">
        
        <!-- Gambar Produk -->
        <div class="col-lg-6 mb-4 mb-lg-0">
          <img src="/{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid rounded" style="width: 100%; object-fit: cover; max-height: 500px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        </div>
  
        <!-- Detail Produk -->
        <div class="col-lg-6">
          <h1 class="fw-bold text-uppercase" style="font-size: 2.5rem; letter-spacing: 1px;">{{ $product->name }}</h1>
          <h5 class="mb-4" style="font-weight: 500; font-size: 1.1rem;">Kategori: {{ $product->category }}</h5>
  
          <p class="fw-bold mb-2">Product details :</p>
          <p class="text-muted" style="font-size: 0.95rem; line-height: 1.6;">
            {{ $product->description ?? 'Deskripsi produk belum tersedia. Produk ini dirancang dengan kualitas terbaik untuk kenyamanan dan keindahan ruangan Anda. Pastikan untuk selalu merawat produk sesuai instruksi agar tahan lebih lama.' }}
          </p>
  
          <!-- Pilihan Warna -->
          <div class="mb-4 mt-4">
            <p class="fw-bold mb-2">Color</p>
            <select class="form-select w-auto bg-transparent shadow-sm" style="min-width: 150px; border-radius: 8px;">
              <option selected>Default</option>
              <option>Grey</option>
              <option>Beige</option>
            </select>
          </div>

          <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            
            <!-- Atur Jumlah -->
            <div class="mb-4 d-flex align-items-center">
              <p class="fw-bold mb-0 me-4" style="width: 100px;">Quantity</p>
              <div class="d-flex align-items-center">
                  <button type="button" class="qty-btn" onclick="kurangiJumlah()">-</button>
                  <div class="qty-val" id="jumlah-display">1</div>
                  <input type="hidden" name="quantity" id="jumlah-input" value="1">
                  <button type="button" class="qty-btn" onclick="tambahJumlah()">+</button>
              </div>
            </div>
    
            <!-- Harga -->
            <div class="mb-4 d-flex align-items-center">
                <p class="fw-bold mb-0 me-4" style="width: 100px;">Total Price :</p>
                <p class="fw-bold mb-0 fs-4">Rp<span id="subtotal">{{ number_format($product->price, 0, ',', '.') }}</span></p>
            </div>
    
            <!-- Tombol Add to Cart -->
            <div class="mt-4" style="max-width: 300px;">
                @if($product->stock > 0)
                  <p class="text-success mb-2" style="font-size: 0.85rem;"><i class="bi bi-check-circle"></i> Stok Tersedia ({{ $product->stock }})</p>
                  <button type="submit" class="btn btn-add-cart w-100 fs-5">Add to cart</button>
                @else
                  <p class="text-danger mb-2" style="font-size: 0.85rem;"><i class="bi bi-x-circle"></i> Stok Kosong</p>
                  <button type="button" class="btn btn-secondary w-100 rounded-pill py-2 fs-5" disabled>Habis</button>
                @endif
            </div>
          </form>
        </div>
      </div>
    </div>
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

  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    const hargaSatuan = {{ $product->price }};
    const maxStock = {{ $product->stock }};
    let jumlah = 1;

    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updateDisplay() {
        document.getElementById('jumlah-display').innerText = jumlah;
        document.getElementById('jumlah-input').value = jumlah;
        const total = hargaSatuan * jumlah;
        document.getElementById('subtotal').innerText = formatRupiah(total);
    }

    function tambahJumlah() {
        if (jumlah < maxStock) {
            jumlah++;
            updateDisplay();
        } else {
            alert('Jumlah melebihi stok yang tersedia!');
        }
    }

    function kurangiJumlah() {
        if (jumlah > 1) {
            jumlah--;
            updateDisplay();
        }
    }
  </script>
</body>
</html>


