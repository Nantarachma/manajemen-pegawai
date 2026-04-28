<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiManPeg') — Manajemen Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --ocean-dark: #0077b6;
            --ocean-mid: #00b4d8;
            --ocean-light: #48cae4;
            --ocean-pale: #90e0ef;
            --ocean-wash: #caf0f8;
            --white: #ffffff;
            --bg: #f4f9fc;
            --surface: #ffffff;
            --text-primary: #1a2332;
            --text-secondary: #4a5568;
            --text-muted: #94a3b8;
            --border: #e8eff5;
            --sidebar-width: 260px;
            --radius: 16px;
            --radius-sm: 10px;
            --shadow-sm: 0 1px 3px rgba(0, 119, 182, 0.04), 0 1px 2px rgba(0, 0, 0, 0.03);
            --shadow-md: 0 4px 16px rgba(0, 119, 182, 0.08);
            --shadow-lg: 0 10px 30px rgba(0, 119, 182, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--white);
            border-right: 1px solid var(--border);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-brand-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--ocean-dark) 0%, var(--ocean-mid) 50%, var(--ocean-light) 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 119, 182, 0.25);
        }

        .sidebar-brand-icon i {
            font-size: 18px;
            color: #fff;
        }

        .sidebar-brand-text h5 {
            color: var(--text-primary);
            font-weight: 800;
            font-size: 18px;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .sidebar-brand-text small {
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 500;
        }

        .sidebar-nav {
            padding: 16px 14px;
            flex: 1;
        }

        .sidebar-nav-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--text-muted);
            padding: 0 12px;
            margin-bottom: 10px;
            margin-top: 16px;
        }

        .sidebar-nav-label:first-child { margin-top: 0; }

        .nav-link-sidebar {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 12px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }

        .nav-link-sidebar:hover {
            background: var(--ocean-wash);
            color: var(--ocean-dark);
        }

        .nav-link-sidebar.active {
            background: linear-gradient(135deg, var(--ocean-dark), var(--ocean-mid));
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 119, 182, 0.25);
        }

        .nav-link-sidebar i {
            width: 20px;
            text-align: center;
            font-size: 15px;
        }

        .sidebar-footer {
            padding: 18px 20px;
            border-top: 1px solid var(--border);
            background: var(--bg);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .sidebar-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--ocean-dark), var(--ocean-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #fff;
            font-weight: 700;
        }

        .sidebar-user-info p {
            margin: 0;
            color: var(--text-primary);
            font-size: 13px;
            font-weight: 600;
        }

        .sidebar-user-info small {
            color: var(--text-muted);
            font-size: 11px;
        }

        .btn-logout {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: 1.5px solid var(--border);
            background: var(--white);
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background: #fef2f2;
            border-color: #fecaca;
            color: #dc2626;
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ========== TOP BAR ========== */
        .topbar {
            padding: 24px 32px 8px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-left h4 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
            letter-spacing: -0.5px;
        }

        .topbar-left p {
            font-size: 14px;
            color: var(--text-muted);
            margin: 4px 0 0 0;
        }

        .btn-mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 20px;
            cursor: pointer;
            padding: 8px;
        }

        /* ========== PAGE CONTENT ========== */
        .page-content {
            padding: 20px 32px 32px 32px;
        }

        /* ========== MODERN CARDS ========== */
        .card-modern {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: box-shadow 0.2s ease;
            overflow: hidden;
        }

        .card-modern:hover {
            box-shadow: var(--shadow-md);
        }

        .card-modern .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border);
            padding: 20px 24px;
            color: var(--text-primary);
        }

        .card-modern .card-header h5 {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
            color: var(--text-primary);
        }

        .card-modern .card-body {
            padding: 24px;
        }

        /* ========== STAT CARDS ========== */
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 100px; height: 100px;
            border-radius: 50%;
            transform: translate(30px, -30px);
            opacity: 0.06;
        }

        .stat-card.ocean::after { background: var(--ocean-dark); }
        .stat-card.sky::after { background: var(--ocean-mid); }
        .stat-card.aqua::after { background: var(--ocean-light); }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 16px;
        }

        .stat-card.ocean .stat-card-icon { background: linear-gradient(135deg, var(--ocean-dark), var(--ocean-mid)); color: #fff; }
        .stat-card.sky .stat-card-icon { background: linear-gradient(135deg, var(--ocean-mid), var(--ocean-light)); color: #fff; }
        .stat-card.aqua .stat-card-icon { background: linear-gradient(135deg, var(--ocean-light), var(--ocean-pale)); color: var(--ocean-dark); }

        .stat-card h3 {
            font-size: 30px;
            font-weight: 800;
            color: var(--text-primary);
            margin: 0;
            letter-spacing: -1px;
        }

        .stat-card p {
            font-size: 13px;
            color: var(--text-muted);
            margin: 4px 0 0 0;
            font-weight: 500;
        }

        /* ========== TABLE ========== */
        .table-modern {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-modern thead th {
            background: var(--bg);
            padding: 14px 16px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }

        .table-modern tbody td {
            padding: 16px;
            font-size: 14px;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .table-modern tbody tr {
            transition: background 0.15s ease;
        }

        .table-modern tbody tr:hover {
            background: var(--ocean-wash);
        }

        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        /* ========== BUTTONS ========== */
        .btn-modern-primary {
            background: linear-gradient(135deg, var(--ocean-dark) 0%, var(--ocean-mid) 100%);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Inter', sans-serif;
        }

        .btn-modern-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 119, 182, 0.3);
            color: #fff;
        }

        .btn-action {
            width: 34px;
            height: 34px;
            border: none;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-action.edit {
            background: var(--ocean-wash);
            color: var(--ocean-dark);
        }

        .btn-action.edit:hover {
            background: linear-gradient(135deg, var(--ocean-dark), var(--ocean-mid));
            color: #fff;
        }

        .btn-action.delete {
            background: #fef2f2;
            color: #ef4444;
        }

        .btn-action.delete:hover {
            background: #ef4444;
            color: #fff;
        }

        /* ========== FORMS ========== */
        .form-modern .form-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
        }

        .form-modern .form-control,
        .form-modern .form-select {
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.2s ease;
            color: var(--text-primary);
            background: var(--bg);
        }

        .form-modern .form-control:focus,
        .form-modern .form-select:focus {
            border-color: var(--ocean-mid);
            box-shadow: 0 0 0 3px rgba(0, 180, 216, 0.12);
            background: var(--white);
        }

        /* ========== BADGE ========== */
        .badge-gender {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-gender.male {
            background: var(--ocean-wash);
            color: var(--ocean-dark);
        }

        .badge-gender.female {
            background: #fce7f3;
            color: #db2777;
        }

        /* ========== ALERTS ========== */
        .alert-modern {
            border: none;
            border-radius: var(--radius-sm);
            padding: 14px 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease;
        }

        .alert-modern.success {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .alert-modern.danger {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ========== EMPTY STATE ========== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 48px;
            color: var(--ocean-pale);
            margin-bottom: 16px;
        }

        .empty-state h5 {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 4px;
        }

        .empty-state p {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* ========== CHART CARD HEADER GRADIENT ========== */
        .chart-header-bar {
            height: 4px;
            background: linear-gradient(90deg, var(--ocean-dark), var(--ocean-mid), var(--ocean-light));
            border-radius: 4px 4px 0 0;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
                box-shadow: 4px 0 20px rgba(0,0,0,0.1);
            }
            .main-content {
                margin-left: 0;
            }
            .btn-mobile-toggle {
                display: block;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(0,0,0,0.3);
                z-index: 999;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }

        @media (max-width: 576px) {
            .page-content, .topbar {
                padding-left: 16px;
                padding-right: 16px;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar Overlay for Mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <i class="fas fa-users-cog"></i>
        </div>
        <div class="sidebar-brand-text">
            <h5>SiManPeg</h5>
            <small>Manajemen Data Pegawai</small>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-nav-label">Menu Utama</div>
        <a href="{{ route('dashboard') }}" class="nav-link-sidebar {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i>
            Dashboard
        </a>
        <a href="{{ route('pegawai.index') }}" class="nav-link-sidebar {{ request()->routeIs('pegawai.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            Data Pegawai
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="sidebar-user-info">
                <p>{{ Auth::user()->name }}</p>
                <small>Administrator</small>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </div>
</aside>

<!-- Main Content -->
<main class="main-content">
    <div class="topbar">
        <div class="topbar-left">
            <button class="btn-mobile-toggle" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <h4>@yield('page-title', 'Dashboard')</h4>
            <p>@yield('page-subtitle', 'Selamat datang kembali, ' . Auth::user()->name)</p>
        </div>
    </div>

    <div class="page-content">
        @if(session('success'))
            <div class="alert-modern success mb-3">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    }
</script>
@stack('scripts')
</body>
</html>
