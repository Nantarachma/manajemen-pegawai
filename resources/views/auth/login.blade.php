<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SiManPeg</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #ffffff;
            overflow: hidden;
        }

        /* ===== LEFT PANEL — Ocean Blue Gradient ===== */
        .left-panel {
            width: 50%;
            min-height: 100vh;
            background: linear-gradient(160deg, #0077b6 0%, #00b4d8 40%, #48cae4 70%, #90e0ef 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Decorative wave shapes */
        .left-panel::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 180px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.08' d='M0,224L48,213.3C96,203,192,181,288,186.7C384,192,480,224,576,218.7C672,213,768,171,864,165.3C960,160,1056,192,1152,197.3C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E") no-repeat bottom;
            background-size: cover;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            top: -2px;
            right: 0;
            width: 100%;
            height: 180px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.06' d='M0,96L48,112C96,128,192,160,288,165.3C384,171,480,149,576,149.3C672,149,768,171,864,186.7C960,203,1056,213,1152,202.7C1248,192,1344,160,1392,144L1440,128L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z'%3E%3C/path%3E%3C/svg%3E") no-repeat top;
            background-size: cover;
        }

        /* Floating bubbles */
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

        .left-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #ffffff;
            padding: 40px;
        }

        .left-content .icon-wrapper {
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 28px;
            animation: iconFloat 4s ease-in-out infinite;
        }

        @keyframes iconFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .left-content .icon-wrapper i {
            font-size: 38px;
            color: #fff;
        }

        .left-content h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
            letter-spacing: -1px;
        }

        .left-content p {
            font-size: 16px;
            opacity: 0.85;
            max-width: 340px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* ===== RIGHT PANEL — White Login Form ===== */
        .right-panel {
            width: 50%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            padding: 40px;
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 400px;
            animation: fadeInRight 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .login-form-wrapper h2 {
            font-size: 28px;
            font-weight: 700;
            color: #1a2332;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .login-form-wrapper .subtitle {
            font-size: 15px;
            color: #8899aa;
            margin-bottom: 36px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #5a6a7a;
            margin-bottom: 8px;
        }

        .form-group .input-wrapper {
            position: relative;
        }

        .form-group .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #aab8c5;
            font-size: 15px;
            transition: color 0.2s;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            color: #1a2332;
            transition: all 0.2s ease;
            background: #f8fafc;
        }

        .form-group input:focus {
            outline: none;
            border-color: #00b4d8;
            box-shadow: 0 0 0 3px rgba(0, 180, 216, 0.12);
            background: #ffffff;
        }

        .form-group input:focus + i,
        .form-group .input-wrapper:focus-within i {
            color: #00b4d8;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .form-check-input:checked {
            background-color: #00b4d8;
            border-color: #00b4d8;
        }

        .form-check-label {
            font-size: 14px;
            color: #5a6a7a;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #0077b6 0%, #00b4d8 50%, #48cae4 100%);
            color: #fff;
            font-weight: 600;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
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

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(0, 119, 182, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            color: #dc2626;
            font-size: 14px;
            padding: 12px 16px;
            margin-bottom: 20px;
        }

        .copyright {
            text-align: center;
            margin-top: 36px;
            color: #c0c8d4;
            font-size: 13px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .left-panel {
                width: 100%;
                min-height: 280px;
                padding: 40px 20px;
            }
            .left-content h1 { font-size: 26px; }
            .left-content p { font-size: 14px; }
            .left-content .icon-wrapper { width: 70px; height: 70px; border-radius: 20px; }
            .left-content .icon-wrapper i { font-size: 28px; }
            .right-panel {
                width: 100%;
                min-height: auto;
                padding: 32px 24px;
            }
        }
    </style>
</head>
<body>

<!-- Left Panel -->
<div class="left-panel">
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>

    <div class="left-content">
        <div class="icon-wrapper">
            <i class="fas fa-users-cog"></i>
        </div>
        <h1>SiManPeg</h1>
        <p>Sistem Informasi Manajemen Data Pegawai Berbasis Web Menggunakan Laravel dan SQLite</p>
    </div>
</div>

<!-- Right Panel -->
<div class="right-panel">
    <div class="login-form-wrapper">
        <h2>Selamat Datang 👋</h2>
        <p class="subtitle">Silakan masuk ke akun Anda untuk melanjutkan</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required autofocus>
                    <i class="fas fa-envelope"></i>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="form-options">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat Saya</label>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Masuk <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>

        <p class="copyright">&copy; {{ date('Y') }} SiManPeg — All rights reserved</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
