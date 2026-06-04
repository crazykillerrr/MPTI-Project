<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PerabotiQ')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f9f8f6; color: #1a1a1a; }
        nav { display: flex; align-items: center; justify-content: space-between; padding: 18px 60px; background: #fff; border-bottom: 1px solid #e8e5e0; }
        nav .logo { font-size: 1.3rem; font-weight: 700; letter-spacing: 0.5px; color: #1a1a1a; text-decoration: none; }
        nav .menu { display: flex; gap: 40px; list-style: none; }
        nav .menu a { text-decoration: none; color: #1a1a1a; font-size: 0.95rem; }
        nav .menu a:hover { opacity: 0.6; }
        nav .nav-btn { padding: 8px 22px; border: 1.5px solid #1a1a1a; border-radius: 20px; background: transparent; color: #1a1a1a; font-size: 0.9rem; cursor: pointer; text-decoration: none; transition: all 0.2s; }
        nav .nav-btn:hover { background: #1a1a1a; color: #fff; }
        .alert-success { background: #e8f5e9; border: 1px solid #c8e6c9; color: #2e7d32; padding: 12px 20px; margin: 10px 60px; border-radius: 6px; font-size: 0.9rem; }
        .alert-error   { background: #fce4ec; border: 1px solid #f8bbd0; color: #c62828; padding: 12px 20px; margin: 10px 60px; border-radius: 6px; font-size: 0.9rem; }
        footer { background: #fff; border-top: 1px solid #e8e5e0; padding: 40px 60px 20px; margin-top: 60px; }
        footer .footer-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 30px; }
        footer .footer-col h4 { font-size: 0.9rem; font-weight: 600; margin-bottom: 10px; }
        footer .footer-col a, footer .footer-col p { font-size: 0.82rem; color: #666; display: block; text-decoration: none; margin-bottom: 4px; }
        footer .footer-bottom { text-align: center; margin-top: 30px; font-size: 0.78rem; color: #aaa; border-top: 1px solid #eee; padding-top: 15px; }
    </style>
    @stack('styles')
</head>
<body>
    <nav>
        <a href="{{ route('home') }}" class="logo">PerabotiQ</a>
        <ul class="menu">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Products</a></li>
        </ul>
        <div style="display:flex;gap:12px;align-items:center;">
            @auth
                <span style="font-size:0.85rem;color:#666;">{{ Auth::user()->name }}</span>
                @if(Auth::user()->role === 'customer')
                    <a href="{{ route('customer.profil') }}" class="nav-btn">My Profile</a>
                    <a href="{{ route('customer.pesanan') }}" class="nav-btn">My Orders</a>
                    <a href="{{ route('keranjang') }}" class="nav-btn">Cart</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-btn">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-btn">Login</a>
            @endauth
        </div>
    </nav>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    @yield('content')

    <footer>
        <div class="footer-grid">
            <div class="footer-col">
                <h4>Orders</h4>
                <p>Find out when your purchase will arrive.</p>
                <a href="#">Track Order</a>
                <a href="#">Schedule Delivery</a>
            </div>
            <div class="footer-col">
                <h4>Contact Us</h4>
                <a href="#">Chat With Us</a>
                <a href="#">Leave Feedback</a>
                <a href="#">Find a store</a>
            </div>
            <div class="footer-col">
                <h4>Our Company</h4>
                <a href="#">About Us</a>
            </div>
            <div class="footer-col">
                <h4>Follow Us</h4>
                <p>#PerabotiQStyle</p>
            </div>
        </div>
        <div class="footer-bottom">&copy;2025 All rights reserved.</div>
    </footer>

    @stack('scripts')
</body>
</html>
