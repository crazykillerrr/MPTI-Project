<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kurir — PerabotiQ')</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Segoe UI',sans-serif; background:#f9f8f6; color:#1a1a1a; display:flex; min-height:100vh; }
        .sidebar { width:220px; background:#fff; border-right:1px solid #e8e5e0; padding:30px 0; flex-shrink:0; }
        .sidebar .brand { padding:0 24px 24px; font-size:1.1rem; font-weight:700; border-bottom:1px solid #eee; }
        .sidebar nav a { display:block; padding:10px 24px; font-size:0.88rem; color:#444; text-decoration:none; border-left:3px solid transparent; }
        .sidebar nav a:hover, .sidebar nav a.active { background:#f5f3f0; border-left-color:#1a1a1a; color:#1a1a1a; font-weight:600; }
        .main { flex:1; display:flex; flex-direction:column; }
        .topbar { background:#fff; border-bottom:1px solid #e8e5e0; padding:14px 30px; display:flex; justify-content:space-between; align-items:center; }
        .topbar span { font-size:0.88rem; color:#666; }
        .logout-btn { padding:6px 18px; border:1.5px solid #1a1a1a; border-radius:20px; background:transparent; font-size:0.82rem; cursor:pointer; }
        .logout-btn:hover { background:#1a1a1a; color:#fff; }
        .content { padding:30px; flex:1; }
        .alert-success { background:#e8f5e9; border:1px solid #c8e6c9; color:#2e7d32; padding:10px 16px; border-radius:6px; margin-bottom:16px; font-size:0.88rem; }
        .alert-error   { background:#fce4ec; border:1px solid #f8bbd0; color:#c62828; padding:10px 16px; border-radius:6px; margin-bottom:16px; font-size:0.88rem; }
        h1 { font-size:1.3rem; font-weight:700; margin-bottom:20px; }
        table { width:100%; border-collapse:collapse; background:#fff; border-radius:8px; }
        th { background:#f5f3f0; padding:12px 16px; text-align:left; font-size:0.82rem; font-weight:600; border-bottom:1px solid #eee; }
        td { padding:12px 16px; font-size:0.85rem; border-bottom:1px solid #f0eeeb; }
        .btn { padding:7px 18px; border-radius:20px; border:1.5px solid #1a1a1a; background:transparent; font-size:0.82rem; cursor:pointer; text-decoration:none; color:#1a1a1a; display:inline-block; }
        .btn:hover { background:#1a1a1a; color:#fff; }
        .card-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:20px; margin-bottom:30px; }
        .card { background:#fff; border:1px solid #e8e5e0; border-radius:10px; padding:20px 24px; }
        .card .label { font-size:0.78rem; color:#888; margin-bottom:6px; }
        .card .value { font-size:1.6rem; font-weight:700; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar">
        <div class="brand">PerabotiQ Kurir</div>
        <nav style="padding:16px 0;">
            <a href="{{ route('kurir.dashboard') }}"  class="{{ request()->routeIs('kurir.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('kurir.pickup') }}"     class="{{ request()->routeIs('kurir.pickup*') ? 'active' : '' }}">Pickup Barang</a>
            <a href="{{ route('kurir.pengiriman') }}" class="{{ request()->routeIs('kurir.pengiriman*') ? 'active' : '' }}">Pengiriman</a>
            <a href="{{ route('kurir.kendala') }}"    class="{{ request()->routeIs('kurir.kendala*') ? 'active' : '' }}">Kendala</a>
        </nav>
    </div>
    <div class="main">
        <div class="topbar">
            <span>Halo, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        <div class="content">
            @if(session('success'))<div class="alert-success">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="alert-error">{{ session('error') }}</div>@endif
            @yield('content')
        </div>
    </div>
    @stack('scripts')
</body>
</html>
