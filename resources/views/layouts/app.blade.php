<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiManPeg') — Manajemen Data Pegawai</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <!-- Genesis Fonts: General Sans (Fontshare) + DM Sans + JetBrains Mono (Google) -->
    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['General Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        sans: ['DM Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'ui-monospace', 'monospace'],
                    },
                    colors: {
                        primary: {
                            DEFAULT: '#6366F1',
                            hover: '#4F46E5',
                            light: '#818CF8',
                            pale: '#C7D2FE',
                            wash: '#EEF2FF',
                        },
                        bg: '#FAFAFA',
                        surface: '#FFFFFF',
                        'text-primary': '#0A0A0A',
                        'text-secondary': '#6B6B6B',
                        'text-muted': '#9C9C9C',
                        border: '#E8E8EC',
                        success: '#10B981',
                        warning: '#F59E0B',
                        error: '#EF4444',
                    }
                }
            }
        }
    </script>
    <style>
        /* Sidebar transition */
        .sidebar { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        /* Smooth row hover */
        .table-row-hover:hover { background: #FAFAFA; }
        /* Animations */
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slideDown { animation: slideDown 0.3s ease; }
        /* Chart header gradient — Genesis indigo */
        .chart-header-bar {
            height: 4px;
            background: linear-gradient(90deg, #4F46E5, #6366F1, #818CF8);
            border-radius: 4px 4px 0 0;
        }
        /* Scrollbar styling */
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-thumb { background: #E8E8EC; border-radius: 4px; }
    </style>
</head>
<body class="font-sans bg-bg text-text-primary min-h-screen">

<!-- Sidebar Overlay for Mobile -->
<div class="fixed inset-0 bg-black/30 z-[999] hidden" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar fixed top-0 left-0 w-[260px] h-screen bg-white border-r border-border z-[1000] flex flex-col overflow-y-auto max-lg:-translate-x-full" id="sidebar">
    <div class="px-5 py-6 flex items-center gap-3.5 border-b border-border">
        <div class="w-11 h-11 bg-primary rounded-[14px] flex items-center justify-center shrink-0 shadow-[0_4px_12px_rgba(99,102,241,0.25)]">
            <i class="fas fa-users-cog text-white text-lg"></i>
        </div>
        <div>
            <h5 class="font-display text-text-primary font-bold text-lg tracking-tight leading-tight">SiManPeg</h5>
            <small class="text-text-muted text-[11px] font-medium">Manajemen Data Pegawai</small>
        </div>
    </div>

    <nav class="px-3.5 py-4 flex-1">
        <div class="text-[11px] font-bold uppercase tracking-wider text-text-muted px-3 mb-2.5">Menu Utama</div>
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium mb-1 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-primary text-white shadow-[0_4px_12px_rgba(99,102,241,0.25)]' : 'text-text-secondary hover:bg-gray-100 hover:text-text-primary' }}">
            <i class="fas fa-chart-pie w-5 text-center text-[15px]"></i>
            Dashboard
        </a>
        <a href="{{ route('pegawai.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium mb-1 transition-all duration-200 {{ request()->routeIs('pegawai.*') && !request()->routeIs('pegawai.import*') && !request()->routeIs('pegawai.export*') ? 'bg-primary text-white shadow-[0_4px_12px_rgba(99,102,241,0.25)]' : 'text-text-secondary hover:bg-gray-100 hover:text-text-primary' }}">
            <i class="fas fa-users w-5 text-center text-[15px]"></i>
            Data Pegawai
        </a>

        <div class="text-[11px] font-bold uppercase tracking-wider text-text-muted px-3 mb-2.5 mt-4">Kelola Data</div>
        <a href="{{ route('pegawai.import.form') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium mb-1 transition-all duration-200 {{ request()->routeIs('pegawai.import*') ? 'bg-primary text-white shadow-[0_4px_12px_rgba(99,102,241,0.25)]' : 'text-text-secondary hover:bg-gray-100 hover:text-text-primary' }}">
            <i class="fas fa-file-import w-5 text-center text-[15px]"></i>
            Import Data
        </a>
        <a href="{{ route('pegawai.export.preview') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium mb-1 transition-all duration-200 {{ request()->routeIs('pegawai.export*') ? 'bg-primary text-white shadow-[0_4px_12px_rgba(99,102,241,0.25)]' : 'text-text-secondary hover:bg-gray-100 hover:text-text-primary' }}">
            <i class="fas fa-file-export w-5 text-center text-[15px]"></i>
            Export CSV
        </a>

        <div class="text-[11px] font-bold uppercase tracking-wider text-text-muted px-3 mb-2.5 mt-4">Sistem</div>
        <a href="{{ route('audit.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium mb-1 transition-all duration-200 {{ request()->routeIs('audit.*') ? 'bg-primary text-white shadow-[0_4px_12px_rgba(99,102,241,0.25)]' : 'text-text-secondary hover:bg-gray-100 hover:text-text-primary' }}">
            <i class="fas fa-history w-5 text-center text-[15px]"></i>
            Riwayat Aktivitas
        </a>
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium mb-1 transition-all duration-200 {{ request()->routeIs('profile.*') ? 'bg-primary text-white shadow-[0_4px_12px_rgba(99,102,241,0.25)]' : 'text-text-secondary hover:bg-gray-100 hover:text-text-primary' }}">
            <i class="fas fa-user-cog w-5 text-center text-[15px]"></i>
            Profil Admin
        </a>
    </nav>

    <div class="px-5 py-4 border-t border-border bg-bg">
        <div class="flex items-center gap-3 mb-3.5">
            <div class="w-[38px] h-[38px] bg-primary rounded-full flex items-center justify-center text-sm text-white font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-text-primary text-[13px] font-semibold leading-tight">{{ Auth::user()->name }}</p>
                <small class="text-text-muted text-[11px]">Administrator</small>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-2.5 rounded-md border border-border bg-white text-text-secondary text-[13px] font-medium cursor-pointer transition-all duration-200 flex items-center justify-center gap-2 hover:bg-red-50 hover:border-red-200 hover:text-red-600">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </div>
</aside>

<!-- Main Content -->
<main class="ml-[260px] min-h-screen max-lg:ml-0 transition-[margin-left] duration-300">
    <div class="px-8 pt-6 pb-2 flex items-center justify-between max-sm:px-4">
        <div>
            <button class="hidden max-lg:block bg-transparent border-none text-text-primary text-xl cursor-pointer p-2" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <h4 class="font-display text-2xl font-bold text-text-primary tracking-[-0.03em]">@yield('page-title', 'Dashboard')</h4>
            <p class="text-sm text-text-muted mt-1">@yield('page-subtitle', 'Selamat datang kembali, ' . Auth::user()->name)</p>
        </div>
    </div>

    <div class="px-8 py-5 pb-8 max-sm:px-4">
        @if(session('success'))
            <div class="flex items-center gap-2.5 px-5 py-3.5 rounded-lg bg-emerald-50 text-emerald-600 border border-emerald-200 text-sm mb-3 animate-slideDown">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('max-lg:-translate-x-full');
            sidebar.classList.toggle('shadow-[4px_0_20px_rgba(0,0,0,0.1)]');
            overlay.classList.toggle('hidden');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.add('max-lg:-translate-x-full');
            sidebar.classList.remove('shadow-[4px_0_20px_rgba(0,0,0,0.1)]');
            overlay.classList.add('hidden');
        });
    }
</script>
@stack('scripts')
</body>
</html>
