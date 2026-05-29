@extends('layouts.app')
@section('title', 'Login - UNDONET')

@section('content')
<style>
    nav, .navbar, footer {
        display: none !important;
    }

    :root {
        --undonet-red: #dc2626;
        --undonet-red-dark: #991b1b;
        --undonet-ink: #111827;
        --undonet-muted: #64748b;
        --undonet-soft: #f8fafc;
        --undonet-line: #e5e7eb;
        --undonet-card: #ffffff;
    }

    body {
        background:
            radial-gradient(circle at top left, rgba(220,38,38,.12), transparent 24rem),
            linear-gradient(180deg, #fff 0%, #f8fafc 100%);
    }

    .auth-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 28px 16px;
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--undonet-ink);
    }

    .auth-shell {
        width: min(1120px, 100%);
        border-radius: 32px;
        overflow: hidden;
        background: var(--undonet-card);
        border: 1px solid rgba(226,232,240,.95);
        box-shadow: 0 30px 80px rgba(15,23,42,.12);
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .auth-visual {
        position: relative;
        padding: 42px;
        color: white;
        background:
            linear-gradient(135deg, rgba(127,29,29,.98), rgba(220,38,38,.94) 48%, rgba(17,24,39,.98)),
            radial-gradient(circle at 80% 18%, rgba(255,255,255,.26), transparent 16rem);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 30px;
    }

    .auth-visual::before {
        content: '';
        position: absolute;
        inset: auto -10% -30% 35%;
        height: 480px;
        background: radial-gradient(circle, rgba(255,255,255,.18), transparent 60%);
        pointer-events: none;
    }

    .brand-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: fit-content;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.18);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        backdrop-filter: blur(10px);
    }

    .brand-logo {
        width: 120px;
        height: 120px;
        border-radius: 28px;
        padding: 14px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.18);
        box-shadow: 0 24px 50px rgba(0,0,0,.2);
        display: grid;
        place-items: center;
    }

    .brand-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .auth-visual h1 {
        font-size: clamp(34px, 4vw, 52px);
        line-height: .98;
        font-weight: 900;
        letter-spacing: -.05em;
        margin: 0 0 14px;
    }

    .auth-visual p {
        max-width: 440px;
        margin: 0;
        color: rgba(255,255,255,.82);
        line-height: 1.8;
        font-size: 15px;
    }

    .auth-points {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-top: 24px;
    }

    .point-card {
        padding: 14px;
        border-radius: 18px;
        background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.14);
        backdrop-filter: blur(10px);
    }

    .point-card .number {
        font-size: 22px;
        font-weight: 900;
        line-height: 1;
    }

    .point-card .label {
        margin-top: 6px;
        font-size: 12px;
        color: rgba(255,255,255,.78);
        font-weight: 700;
    }

    .auth-form {
        padding: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
    }

    .form-card {
        width: 100%;
        max-width: 420px;
    }

    .section-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 14px;
        border-radius: 999px;
        background: #fff1f2;
        color: var(--undonet-red);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .section-title {
        margin: 16px 0 8px;
        font-size: clamp(30px, 4vw, 42px);
        line-height: 1.05;
        font-weight: 900;
        letter-spacing: -.05em;
        color: var(--undonet-ink);
    }

    .section-sub {
        margin-bottom: 26px;
        color: var(--undonet-muted);
        font-size: 15px;
        line-height: 1.8;
    }

    .form-label {
        font-size: 13px;
        font-weight: 800;
        color: var(--undonet-ink);
        margin-bottom: 8px;
    }

    .form-control {
        min-height: 48px;
        border-radius: 14px;
        border: 1px solid var(--undonet-line);
        background: var(--undonet-soft);
        padding: 12px 14px;
        font-size: 14px;
        box-shadow: none !important;
    }

    .form-control:focus {
        border-color: var(--undonet-red);
        background: white;
    }

    .btn-undonet-primary,
    .btn-undonet-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 46px;
        border-radius: 14px;
        font-weight: 800;
        text-decoration: none;
        transition: .25s ease;
    }

    .btn-undonet-primary {
        border: 0;
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        color: white;
        box-shadow: 0 18px 38px rgba(220,38,38,.24);
    }

    .btn-undonet-primary:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 22px 44px rgba(220,38,38,.30);
    }

    .btn-undonet-outline {
        border: 1px solid var(--undonet-line);
        color: var(--undonet-ink);
        background: white;
    }

    .btn-undonet-outline:hover {
        color: var(--undonet-red);
        border-color: #fecaca;
        background: #fff7f7;
    }

    .auth-links {
        margin-top: 20px;
        color: var(--undonet-muted);
        font-size: 13px;
        text-align: center;
    }

    .auth-links a {
        color: var(--undonet-red);
        font-weight: 800;
        text-decoration: none;
    }

    .footer-note {
        margin-top: 22px;
        color: var(--undonet-muted);
        font-size: 12px;
        text-align: center;
    }

    .alert {
        border-radius: 16px;
        border: 1px solid #fecaca;
        background: #fff1f2;
        color: #b91c1c;
    }

    @media (max-width: 991.98px) {
        .auth-shell {
            grid-template-columns: 1fr;
        }

        .auth-visual {
            padding: 28px;
        }

        .auth-points {
            grid-template-columns: 1fr;
        }

        .auth-form {
            padding: 28px;
        }
    }

    @media (max-width: 575.98px) {
        .auth-page {
            padding: 14px;
        }

        .auth-shell {
            border-radius: 24px;
        }

        .auth-visual {
            padding: 22px;
        }

        .auth-form {
            padding: 22px;
        }

        .brand-logo {
            width: 92px;
            height: 92px;
        }
    }
</style>

<div class="auth-page">
    <div class="auth-shell">
        <section class="auth-visual">
            <div>
                <div class="brand-badge">
                    <i class="bi bi-box-arrow-in-right"></i>
                    UNDONET Login
                </div>

                <div class="mt-4">
                    <div class="brand-logo mb-4">
                        <img src="{{ asset('storage/logoperusahaanfaiziy.png') }}" alt="UNDONET Logo">
                    </div>
                    <h1>Internet cepat, stabil, dan siap dipakai setiap hari.</h1>
                    <p>
                        Masuk ke akun Anda untuk melihat paket, mengelola pesanan, dan melanjutkan layanan internet UNDONET dengan lebih mudah.
                    </p>
                </div>
            </div>

            <div class="auth-points">
                <div class="point-card">
                    <div class="number">24/7</div>
                    <div class="label">Monitoring jaringan</div>
                </div>
                <div class="point-card">
                    <div class="number">1 Hari</div>
                    <div class="label">Estimasi instalasi</div>
                </div>
                <div class="point-card">
                    <div class="number">99%</div>
                    <div class="label">Stabilitas layanan</div>
                </div>
            </div>
        </section>

        <section class="auth-form">
            <div class="form-card">
                <span class="section-kicker"><i class="bi bi-box-arrow-in-right"></i> Login</span>
                <h2 class="section-title">Selamat datang kembali.</h2>
                <p class="section-sub">Silakan masuk menggunakan email atau username dan password yang terdaftar.</p>

                @if($errors->any())
                    <div class="alert py-3 px-3 mb-3">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert py-3 px-3 mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email atau Username</label>
                        <input type="text" name="login" value="{{ old('login') }}" class="form-control" placeholder="Masukkan email atau username" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
                        <a href="{{ url('/') }}" class="btn-undonet-outline px-3">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>
                        <a href="#" class="text-decoration-none" style="color: var(--undonet-muted); font-size: 13px; font-weight: 700;">
                            Lupa kata sandi?
                        </a>
                    </div>

                    <button type="submit" class="btn btn-undonet-primary w-100">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Masuk
                    </button>
                </form>

                <div class="auth-links">
                    Belum punya akun?
                    <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>

                <div class="footer-note">
                    UNDONET — Internet fiber cepat dan stabil
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
