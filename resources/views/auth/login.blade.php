<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SiManPeg</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['General Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        sans: ['DM Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: { DEFAULT: '#6366F1', hover: '#4F46E5', light: '#818CF8', pale: '#C7D2FE', wash: '#EEF2FF' },
                    }
                }
            }
        }
    </script>
    <style>
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: rise 12s ease-in-out infinite;
        }
        .bubble:nth-child(1) { width: 80px; height: 80px; left: 10%; bottom: -80px; animation-delay: 0s; animation-duration: 10s; }
        .bubble:nth-child(2) { width: 50px; height: 50px; left: 30%; bottom: -50px; animation-delay: 2s; animation-duration: 14s; }
        .bubble:nth-child(3) { width: 120px; height: 120px; left: 60%; bottom: -120px; animation-delay: 4s; animation-duration: 16s; }
        .bubble:nth-child(4) { width: 40px; height: 40px; left: 80%; bottom: -40px; animation-delay: 1s; animation-duration: 11s; }
        .bubble:nth-child(5) { width: 60px; height: 60px; left: 45%; bottom: -60px; animation-delay: 3s; animation-duration: 13s; }

        @keyframes rise {
            0%   { transform: translateY(0) scale(1); opacity: 0.5; }
            50%  { opacity: 0.3; }
            100% { transform: translateY(-110vh) scale(0.6); opacity: 0; }
        }
        @keyframes iconFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-iconFloat { animation: iconFloat 4s ease-in-out infinite; }
        .animate-fadeInRight { animation: fadeInRight 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }

        .wave-bottom::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 180px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.08' d='M0,224L48,213.3C96,203,192,181,288,186.7C384,192,480,224,576,218.7C672,213,768,171,864,165.3C960,160,1056,192,1152,197.3C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E") no-repeat bottom;
            background-size: cover;
        }

        .btn-login {
            position: relative;
            overflow: hidden;
        }
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        .btn-login:hover::before { left: 100%; }
    </style>
</head>
<body class="font-sans min-h-screen flex flex-col md:flex-row overflow-hidden">

<!-- Left Panel -->
<div class="wave-bottom w-full md:w-1/2 min-h-[280px] md:min-h-screen bg-gradient-to-br from-primary-hover via-primary to-primary-pale flex flex-col items-center justify-center relative overflow-hidden">
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>

    <div class="relative z-10 text-center text-white px-10 py-10">
        <div class="animate-iconFloat w-[90px] h-[90px] bg-white/20 backdrop-blur-sm border-2 border-white/30 rounded-[28px] inline-flex items-center justify-center mb-7">
            <i class="fas fa-users-cog text-4xl text-white"></i>
        </div>
        <h1 class="font-display text-4xl md:text-[36px] font-bold tracking-[-0.04em] mb-3">SiManPeg</h1>
        <p class="text-base opacity-85 max-w-[340px] mx-auto leading-relaxed">Sistem Informasi Manajemen Data Pegawai Berbasis Web Menggunakan Laravel dan SQLite</p>
    </div>
</div>

<!-- Right Panel -->
<div class="w-full md:w-1/2 min-h-screen flex items-center justify-center bg-[#FAFAFA] px-6 md:px-10">
    <div class="animate-fadeInRight w-full max-w-[400px]">
        <h2 class="font-display text-[28px] font-bold text-[#0A0A0A] tracking-[-0.03em] mb-1.5">Selamat Datang 👋</h2>
        <p class="text-[15px] text-[#9C9C9C] mb-9">Silakan masuk ke akun Anda untuk melanjutkan</p>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg text-red-600 text-sm px-4 py-3 mb-5">
                <i class="fas fa-exclamation-circle mr-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-[13px] font-semibold text-[#6B6B6B] mb-2">Email</label>
                <div class="relative">
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required autofocus class="w-full py-3.5 pl-12 pr-4 border border-[#E8E8EC] rounded-md text-[15px] text-[#0A0A0A] bg-white transition-all focus:outline-none focus:border-primary focus:ring-[3px] focus:ring-primary/10">
                    <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-[#9C9C9C] text-[15px]"></i>
                </div>
            </div>

            <div class="mb-5">
                <label for="password" class="block text-[13px] font-semibold text-[#6B6B6B] mb-2">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required class="w-full py-3.5 pl-12 pr-4 border border-[#E8E8EC] rounded-md text-[15px] text-[#0A0A0A] bg-white transition-all focus:outline-none focus:border-primary focus:ring-[3px] focus:ring-primary/10">
                    <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-[#9C9C9C] text-[15px]"></i>
                </div>
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded accent-primary">
                    <span class="text-sm text-[#6B6B6B]">Ingat Saya</span>
                </label>
            </div>

            <button type="submit" class="btn-login w-full py-4 rounded-md bg-primary text-white font-semibold text-base border-none cursor-pointer transition-all hover:-translate-y-0.5 hover:shadow-[0_4px_12px_rgba(99,102,241,0.35)]">
                Masuk <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>

        <p class="text-center mt-9 text-[#9C9C9C] text-[13px]">&copy; {{ date('Y') }} SiManPeg — All rights reserved</p>
    </div>
</div>

</body>
</html>
