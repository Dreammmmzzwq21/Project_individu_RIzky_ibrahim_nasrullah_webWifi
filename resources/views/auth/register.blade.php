@extends('layouts.app')
@section('title', 'Daftar Akun - UNDONET')

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
        width: min(1180px, 100%);
        border-radius: 32px;
        overflow: hidden;
        background: var(--undonet-card);
        border: 1px solid rgba(226,232,240,.95);
        box-shadow: 0 30px 80px rgba(15,23,42,.12);
        display: grid;
        grid-template-columns: 1fr 1.15fr;
    }

    .auth-visual {
        position: relative;
        padding: 42px;
        color: white;
        background:
            linear-gradient(135deg, rgba(17,24,39,.98), rgba(127,29,29,.96) 46%, rgba(220,38,38,.92)),
            radial-gradient(circle at 80% 18%, rgba(255,255,255,.24), transparent 16rem);
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
        font-size: clamp(34px, 4vw, 54px);
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
        background: white;
    }

    .form-card {
        width: 100%;
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

    .form-control,
    .form-select {
        min-height: 48px;
        border-radius: 14px;
        border: 1px solid var(--undonet-line);
        background: var(--undonet-soft);
        padding: 12px 14px;
        font-size: 14px;
        box-shadow: none !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--undonet-red);
        background: white;
    }

    textarea.form-control {
        min-height: 92px;
        resize: vertical;
    }

    .radio-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .radio-card {
        flex: 1 1 160px;
        border: 1px solid var(--undonet-line);
        border-radius: 16px;
        background: var(--undonet-soft);
        padding: 12px 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .radio-card .form-check-input {
        margin-top: 0;
        box-shadow: none !important;
    }

    .radio-card .form-check-input:checked {
        background-color: var(--undonet-red);
        border-color: var(--undonet-red);
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
                    <i class="bi bi-person-plus"></i>
                    UNDONET Registration
                </div>

                <div class="mt-4">
                    <div class="brand-logo mb-4">
                        <img src="{{ asset('storage/logoperusahaanfaiziy.png') }}" alt="UNDONET Logo">
                    </div>
                    <h1>Buat akun untuk menikmati layanan internet yang lebih mudah.</h1>
                    <p>
                        Daftar sekarang untuk melihat paket, melanjutkan pemesanan, dan mengakses layanan pelanggan UNDONET dengan lebih cepat.
                    </p>
                </div>
            </div>

            <div class="auth-points">
                <div class="point-card">
                    <div class="number">500+</div>
                    <div class="label">Pelanggan aktif</div>
                </div>
                <div class="point-card">
                    <div class="number">24/7</div>
                    <div class="label">Monitoring jaringan</div>
                </div>
                <div class="point-card">
                    <div class="number">1 Hari</div>
                    <div class="label">Estimasi instalasi</div>
                </div>
            </div>
        </section>

        <section class="auth-form">
            <div class="form-card">
                <span class="section-kicker"><i class="bi bi-person-plus"></i> Register</span>
                <h2 class="section-title">Buat akun baru.</h2>
                <p class="section-sub">Lengkapi data diri Anda untuk mulai menggunakan layanan UNDONET.</p>

                @if($errors->any())
                    <div class="alert py-3 px-3 mb-3">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Nama lengkap" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Username" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="nama@email.com" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">No. HP</label>
                            <input type="text" name="hp" value="{{ old('hp') }}" class="form-control" placeholder="08xxxxxxxxxx">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Jenis Kelamin</label>
                            <div class="radio-wrap">
                                <label class="radio-card form-check m-0">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="reg_l" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} required>
                                    <span class="form-check-label">Laki-laki</span>
                                </label>

                                <label class="radio-card form-check m-0">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="reg_p" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                                    <span class="form-check-label">Perempuan</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap...">{{ old('alamat') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch gap-3 mt-4">
                        <a href="{{ url('/') }}" class="btn-undonet-outline px-3">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-undonet-primary px-4">
                            <i class="bi bi-person-check"></i>
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                <div class="auth-links">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">Masuk di sini</a>
                </div>

                <div class="footer-note">
                    UNDONET — Internet fiber cepat dan stabil
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
