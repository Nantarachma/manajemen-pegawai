<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SiManPeg</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
                    colors: {
                        ocean: { dark: '#0077b6', mid: '#00b4d8', light: '#48cae4', pale: '#90e0ef', wash: '#caf0f8' },
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
<div class="wave-bottom w-full md:w-1/2 min-h-[280px] md:min-h-screen bg-gradient-to-br from-ocean-dark via-ocean-mid to-ocean-pale flex flex-col items-center justify-center relative overflow-hidden">
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>

    <div class="relative z-10 text-center text-white px-10 py-10">
        <div class="animate-iconFloat w-[90px] h-[90px] bg-white/20 backdrop-blur-sm border-2 border-white/30 rounded-[28px] inline-flex items-center justify-center mb-7">
            <i class="fas fa-users-cog text-4xl text-white"></i>
        </div>
        <h1 class="text-4xl md:text-[36px] font-extrabold tracking-tight mb-3">SiManPeg</h1>
        <p class="text-base opacity-85 max-w-[340px] mx-auto leading-relaxed">Sistem Informasi Manajemen Data Pegawai Berbasis Web Menggunakan Laravel dan SQLite</p>
    </div>
</div>

<!-- Right Panel -->
<div class="w-full md:w-1/2 min-h-screen flex items-center justify-center bg-white px-6 md:px-10">
    <div class="animate-fadeInRight w-full max-w-[400px]">
        <h2 class="text-[28px] font-bold text-[#1a2332] tracking-tight mb-1.5">Selamat Datang 👋</h2>
        <p class="text-[15px] text-[#8899aa] mb-9">Silakan masuk ke akun Anda untuk melanjutkan</p>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm px-4 py-3 mb-5">
                <i class="fas fa-exclamation-circle mr-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-[13px] font-semibold text-[#5a6a7a] mb-2">Email</label>
                <div class="relative">
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required autofocus class="w-full py-3.5 pl-12 pr-4 border-[1.5px] border-[#e2e8f0] rounded-xl text-[15px] text-[#1a2332] bg-[#f8fafc] transition-all focus:outline-none focus:border-ocean-mid focus:ring-[3px] focus:ring-ocean-mid/10 focus:bg-white">
                    <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-[#aab8c5] text-[15px] transition-colors peer-focus:text-ocean-mid"></i>
                </div>
            </div>

            <div class="mb-5">
                <label for="password" class="block text-[13px] font-semibold text-[#5a6a7a] mb-2">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required class="w-full py-3.5 pl-12 pr-4 border-[1.5px] border-[#e2e8f0] rounded-xl text-[15px] text-[#1a2332] bg-[#f8fafc] transition-all focus:outline-none focus:border-ocean-mid focus:ring-[3px] focus:ring-ocean-mid/10 focus:bg-white">
                    <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-[#aab8c5] text-[15px]"></i>
                </div>
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded accent-ocean-mid">
                    <span class="text-sm text-[#5a6a7a]">Ingat Saya</span>
                </label>
            </div>

            <button type="submit" class="btn-login w-full py-4 rounded-xl bg-gradient-to-r from-ocean-dark via-ocean-mid to-ocean-light text-white font-semibold text-base border-none cursor-pointer transition-all hover:-translate-y-0.5 hover:shadow-[0_10px_28px_rgba(0,119,182,0.3)]">
                Masuk <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>

        <p class="text-center mt-9 text-[#c0c8d4] text-[13px]">&copy; {{ date('Y') }} SiManPeg — All rights reserved</p>
    </div>
</div>

</body>
</html>
