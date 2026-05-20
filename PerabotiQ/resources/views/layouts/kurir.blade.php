<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kurir — PerabotiQ')</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #7D7568;
            color: #2D2A26;
            display: flex;
            min-height: 100vh;
            font-size: 14px;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 236px;
            background: #EAE7E1;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 28px 22px 22px;
            font-size: 1rem;
            font-weight: 700;
            color: #2D2A26;
            letter-spacing: -0.01em;
            border-bottom: 1px solid #D4CFC8;
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .brand-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #2D2A26;
            flex-shrink: 0;
        }

        .sidebar nav { padding: 14px 14px; flex: 1; }

        .sidebar nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #5A5650;
            text-decoration: none;
            border-radius: 7px;
            margin-bottom: 2px;
            transition: background 0.13s, color 0.13s;
        }

        .sidebar nav a svg { flex-shrink: 0; opacity: 0.7; }
        .sidebar nav a:hover { background: #D8D4CE; color: #2D2A26; }
        .sidebar nav a:hover svg { opacity: 1; }
        .sidebar nav a.active {
            background: #D8D4CE;
            color: #2D2A26;
            font-weight: 600;
        }
        .sidebar nav a.active svg { opacity: 1; }

        /* ── MAIN ── */
        .main { flex: 1; padding: 26px; min-height: 100vh; overflow-y: auto; }

        /* ── CARD ── */
        .card {
            background: #F0EDE8;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 22px;
        }

        /* ── ALERTS ── */
        .alert-success {
            background: #ECFDF5; border: 1px solid #A7F3D0; color: #065F46;
            padding: 10px 14px; border-radius: 8px; margin-bottom: 14px; font-size: 0.85rem;
        }
        .alert-error {
            background: #FFF1F2; border: 1px solid #FECDD3; color: #9F1239;
            padding: 10px 14px; border-radius: 8px; margin-bottom: 14px; font-size: 0.85rem;
        }

        /* ── TABLE ── */
        table { width: 100%; border-collapse: collapse; }
        th {
            padding: 10px 14px; text-align: left;
            font-size: 0.72rem; font-weight: 600;
            color: #8C877F; text-transform: uppercase; letter-spacing: 0.06em;
            border-bottom: 1px solid #DDD9D3;
        }
        td {
            padding: 12px 14px; font-size: 0.875rem;
            color: #2D2A26; border-bottom: 1px solid #E8E4DF;
        }
        tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: rgba(0,0,0,0.015); }

        /* ── BUTTONS ── */
        .btn {
            padding: 7px 16px; border-radius: 7px; font-size: 0.82rem;
            font-weight: 500; cursor: pointer; text-decoration: none;
            display: inline-flex; align-items: center; gap: 5px;
            transition: all 0.13s; font-family: 'DM Sans', sans-serif;
            border: 1.5px solid transparent;
        }
        .btn-outline { border-color: #C8C3BC; background: transparent; color: #2D2A26; }
        .btn-outline:hover { border-color: #2D2A26; background: #2D2A26; color: #fff; }
        .btn-solid { border-color: #2D2A26; background: #2D2A26; color: #fff; }
        .btn-solid:hover { background: #1a1815; border-color: #1a1815; }
        .btn-accent { border: none; background: #4E7FA8; color: #fff; }
        .btn-accent:hover { background: #3D6A90; }
        .btn-ghost {
            border: 1.5px solid #C8C3BC; background: #F0EDE8; color: #2D2A26;
            border-radius: 7px; padding: 7px 16px; font-size: 0.82rem;
            cursor: pointer; font-family: 'DM Sans', sans-serif; font-weight: 500;
        }
        .btn-ghost:hover { background: #E2DED8; }

        /* ── BADGES ── */
        .badge {
            padding: 3px 9px; border-radius: 5px; font-size: 0.72rem;
            font-weight: 600; display: inline-block; white-space: nowrap;
        }
        .badge-yellow    { background: #FEF3C7; color: #92400E; }
        .badge-green     { background: #D1FAE5; color: #065F46; }
        .badge-red       { background: #FFE4E6; color: #9F1239; }
        .badge-blue      { background: #DBEAFE; color: #1E40AF; }
        .badge-slate     { background: #E0F2FE; color: #0369A1; }
        .badge-rose      { background: #FCE7F3; color: #9D174D; }
        .badge-neutral   { background: #E8E4DF; color: #6B6560; }

        /* ── FORMS ── */
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 600; color: #2D2A26; margin-bottom: 5px; }
        .form-control {
            width: 100%; padding: 9px 13px; border: 1.5px solid #D4CFC8;
            border-radius: 7px; font-size: 0.875rem; font-family: 'DM Sans', sans-serif;
            color: #2D2A26; background: #F8F6F3; transition: border-color 0.13s;
        }
        .form-control:focus { outline: none; border-color: #9E9890; background: #fff; }

        /* ── STAT ICON BOX ── */
        .stat-icon {
            width: 40px; height: 40px; border-radius: 8px;
            background: #E2DED8; display: flex; align-items: center;
            justify-content: center; flex-shrink: 0;
        }

        /* ── SECTION HEADER ── */
        .section-title {
            font-size: 0.8rem; font-weight: 700; color: #8C877F;
            text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 14px;
        }

        /* ── PAGE TITLE ── */
        .page-title { font-size: 1.55rem; font-weight: 700; color: #2D2A26; letter-spacing: -0.02em; margin-bottom: 3px; }
        .page-sub   { font-size: 0.87rem; color: #6B6560; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-dot"></div>
            PerabotiQ
        </div>
        <nav>
            <a href="{{ route('kurir.dashboard') }}" class="{{ request()->routeIs('kurir.dashboard') ? 'active' : '' }}">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('kurir.pickup') }}" class="{{ request()->routeIs('kurir.pickup*') ? 'active' : '' }}">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
                Pickup Packages
            </a>
            <a href="{{ route('kurir.pengiriman') }}" class="{{ request()->routeIs('kurir.pengiriman*') ? 'active' : '' }}">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
                Delivery Status
            </a>
            <a href="{{ route('kurir.kendala') }}" class="{{ request()->routeIs('kurir.kendala*') ? 'active' : '' }}">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                Delivery Issues
            </a>
        </nav>
    </div>

    <div class="main">
        @if(session('success'))<div class="alert-success">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert-error">{{ session('error') }}</div>@endif
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
