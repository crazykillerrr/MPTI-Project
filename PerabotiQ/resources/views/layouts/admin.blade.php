<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin — PerabotiQ')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* ========== CSS Variables (matching customer theme) ========== */
        :root {
            --sidebar-bg: #696969;
            --sidebar-hover: #7a7a7a;
            --sidebar-active-bg: rgba(239, 102, 3, 0.15);
            --accent: #ef6603;
            --accent-light: #ff8534;
            --accent-glow: rgba(239, 102, 3, 0.2);
            --topbar-bg: #ffffff;
            --body-bg: #f5f3f0;
            --card-bg: #ffffff;
            --card-border: #e8e5e0;
            --text-primary: #2a2c39;
            --text-secondary: #666666;
            --text-muted: #999999;
            --text-white: #ffffff;
            --success: #2e7d32;
            --success-bg: #e8f5e9;
            --success-border: #c8e6c9;
            --danger: #c62828;
            --danger-bg: #fce4ec;
            --danger-border: #f8bbd0;
            --warning-bg: #fff3e0;
            --warning-text: #e65100;
            --font: 'Poppins', sans-serif;
            --radius: 10px;
            --radius-lg: 14px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 8px 30px rgba(0,0,0,0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ========== Reset & Base ========== */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font);
            background: var(--body-bg);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ========== Sidebar ========== */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            transition: var(--transition);
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            padding: 28px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand .brand-icon {
            width: 42px;
            height: 42px;
            background: var(--accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #fff;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(239, 102, 3, 0.3);
        }

        .sidebar-brand .brand-text {
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand .brand-text h2 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        .sidebar-brand .brand-text span {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.6);
            font-weight: 400;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            padding: 20px 0;
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-nav .nav-label {
            padding: 8px 24px 8px;
            font-size: 0.68rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.4);
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 24px;
            font-size: 0.88rem;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            transition: var(--transition);
            border-left: 3px solid transparent;
            margin: 2px 0;
            font-weight: 400;
        }

        .sidebar-nav a i {
            font-size: 1.15rem;
            width: 22px;
            text-align: center;
            transition: var(--transition);
        }

        .sidebar-nav a:hover {
            background: var(--sidebar-hover);
            color: #fff;
            border-left-color: rgba(255,255,255,0.3);
        }

        .sidebar-nav a.active {
            background: var(--sidebar-active-bg);
            color: var(--accent-light);
            border-left-color: var(--accent);
            font-weight: 600;
        }

        .sidebar-nav a.active i {
            color: var(--accent);
        }

        .sidebar-footer {
            padding: 16px 24px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-footer a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.82rem;
            padding: 8px 0;
            transition: var(--transition);
        }

        .sidebar-footer a:hover {
            color: #fff;
        }

        /* ========== Main Content ========== */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-left: 260px;
            min-height: 100vh;
            transition: var(--transition);
        }

        /* ========== Topbar ========== */
        .topbar {
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--card-border);
            padding: 0 30px;
            height: 68px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-sm);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.4rem;
            color: var(--text-primary);
            cursor: pointer;
            padding: 4px;
            border-radius: 8px;
            transition: var(--transition);
        }

        .sidebar-toggle:hover {
            background: var(--body-bg);
        }

        .topbar-title {
            font-size: 0.92rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .topbar-title strong {
            color: var(--text-primary);
            font-weight: 600;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-info .user-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.2;
        }

        .user-info .user-role {
            font-size: 0.72rem;
            color: var(--text-muted);
            font-weight: 400;
        }

        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 20px;
            border: 1.5px solid var(--card-border);
            border-radius: 8px;
            background: transparent;
            font-size: 0.82rem;
            font-family: var(--font);
            cursor: pointer;
            color: var(--text-secondary);
            transition: var(--transition);
            text-decoration: none;
        }

        .logout-btn:hover {
            border-color: var(--danger);
            color: var(--danger);
            background: var(--danger-bg);
        }

        /* ========== Content ========== */
        .content {
            padding: 30px;
            flex: 1;
        }

        /* ========== Alerts ========== */
        .alert {
            padding: 14px 20px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.4s ease;
            border: 1px solid;
        }

        .alert-success {
            background: var(--success-bg);
            border-color: var(--success-border);
            color: var(--success);
        }

        .alert-error {
            background: var(--danger-bg);
            border-color: var(--danger-border);
            color: var(--danger);
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ========== Page Header ========== */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .page-header p {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin: 4px 0 0;
        }

        /* ========== Cards ========== */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-lg);
            padding: 24px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--accent-light));
            opacity: 0;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .stat-card .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .stat-card .card-icon.orange { background: rgba(239, 102, 3, 0.1); color: var(--accent); }
        .stat-card .card-icon.green  { background: rgba(46, 125, 50, 0.1);  color: var(--success); }
        .stat-card .card-icon.blue   { background: rgba(25, 118, 210, 0.1); color: #1976d2; }
        .stat-card .card-icon.purple { background: rgba(123, 31, 162, 0.1); color: #7b1fa2; }

        .stat-card .label {
            font-size: 0.78rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card .value {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-top: 4px;
        }

        /* ========== Tables ========== */
        .table-container {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: var(--body-bg);
            padding: 14px 20px;
            text-align: left;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--card-border);
        }

        td {
            padding: 14px 20px;
            font-size: 0.88rem;
            border-bottom: 1px solid #f5f3f0;
            transition: var(--transition);
            color: var(--text-primary);
        }

        tbody tr {
            transition: var(--transition);
        }

        tbody tr:hover {
            background: rgba(239, 102, 3, 0.03);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* ========== Buttons ========== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 20px;
            border-radius: 8px;
            border: 1.5px solid var(--card-border);
            background: var(--card-bg);
            font-size: 0.82rem;
            font-family: var(--font);
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            color: var(--text-primary);
            transition: var(--transition);
            white-space: nowrap;
        }

        .btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            box-shadow: 0 2px 8px var(--accent-glow);
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .btn-primary:hover {
            background: var(--accent-light);
            border-color: var(--accent-light);
            color: #fff;
            box-shadow: 0 4px 15px rgba(239, 102, 3, 0.3);
        }

        .btn-danger {
            border-color: var(--danger);
            color: var(--danger);
            background: transparent;
        }

        .btn-danger:hover {
            background: var(--danger);
            color: #fff;
        }

        .btn-success {
            border-color: var(--success);
            color: var(--success);
            background: transparent;
        }

        .btn-success:hover {
            background: var(--success);
            color: #fff;
        }

        .btn-sm {
            padding: 6px 14px;
            font-size: 0.78rem;
        }

        /* ========== Badges ========== */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .badge-success { background: var(--success-bg); color: var(--success); }
        .badge-danger  { background: var(--danger-bg);  color: var(--danger); }
        .badge-warning { background: var(--warning-bg); color: var(--warning-text); }
        .badge-info    { background: rgba(25,118,210,0.1); color: #1976d2; }
        .badge-neutral { background: var(--body-bg); color: var(--text-secondary); }

        /* ========== Forms ========== */
        .form-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-lg);
            padding: 32px;
            max-width: 640px;
            box-shadow: var(--shadow-sm);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 11px 16px;
            border: 1.5px solid var(--card-border);
            border-radius: 8px;
            font-size: 0.9rem;
            font-family: var(--font);
            color: var(--text-primary);
            background: var(--card-bg);
            transition: var(--transition);
            outline: none;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .form-file {
            padding: 10px 16px;
            border: 1.5px dashed var(--card-border);
            border-radius: 8px;
            background: var(--body-bg);
            cursor: pointer;
            transition: var(--transition);
        }

        .form-file:hover {
            border-color: var(--accent);
        }

        .form-hint {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 6px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid var(--card-border);
        }

        /* ========== Empty State ========== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 12px;
            opacity: 0.3;
        }

        .empty-state p {
            font-size: 0.92rem;
        }

        /* ========== Detail Card ========== */
        .detail-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-lg);
            padding: 28px;
            max-width: 720px;
            margin-bottom: 24px;
            box-shadow: var(--shadow-sm);
        }

        .detail-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #f5f3f0;
            font-size: 0.88rem;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-row .detail-label {
            width: 140px;
            font-weight: 600;
            color: var(--text-secondary);
            flex-shrink: 0;
        }

        .detail-row .detail-value {
            color: var(--text-primary);
        }

        /* ========== Responsive ========== */
        @media (max-width: 1024px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.4);
                z-index: 999;
            }

            .sidebar-overlay.show {
                display: block;
            }

            .card-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 20px;
            }

            .topbar {
                padding: 0 20px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .user-info {
                display: none;
            }
        }

        /* ========== Scrollbar ========== */
        .sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 4px;
        }

        /* ========== Animation ========== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeInUp 0.5s ease forwards;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-text">
                <h2>PerabotiQ</h2>
                <span>Admin Panel</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Main Menu</div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="{{ route('admin.produk') }}" class="{{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill"></i> Products
            </a>
            <a href="{{ route('admin.pesanan') }}" class="{{ request()->routeIs('admin.pesanan*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> Orders
            </a>
            <a href="{{ route('admin.transaksi') }}" class="{{ request()->routeIs('admin.transaksi*') ? 'active' : '' }}">
                <i class="bi bi-credit-card-fill"></i> Transactions
            </a>

            <div class="nav-label" style="margin-top: 12px;">Analytics</div>
            <a href="{{ route('admin.laporan') }}" class="{{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line-fill"></i> Reports
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="/" target="_blank">
                <i class="bi bi-globe2"></i> View Website
            </a>
        </div>
    </aside>

    <!-- Main -->
    <div class="main-wrapper">
        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-left">
                <button class="sidebar-toggle" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <div class="topbar-title">
                    @yield('topbar-title', 'Welcome to PerabotiQ Admin')
                </div>
            </div>
            <div class="topbar-right">
                <div class="topbar-user">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">Administrator</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <main class="content fade-in">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first() }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }

        // Auto-dismiss alerts
        document.querySelectorAll('.alert').forEach(function(alert) {
            setTimeout(function() {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                alert.style.transition = 'all 0.4s ease';
                setTimeout(function() { alert.remove(); }, 400);
            }, 5000);
        });
    </script>
    @stack('scripts')
</body>
</html>
