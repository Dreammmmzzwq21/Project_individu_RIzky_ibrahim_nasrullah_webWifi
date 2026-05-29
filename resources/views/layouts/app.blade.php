<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNDONET - @yield('title', 'Internet Provider')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
.footer-undonet {
    position: relative;
    overflow: hidden;
    background:
        radial-gradient(circle at top left, rgba(255,255,255,0.08), transparent 30%),
        linear-gradient(135deg, #7f1d1d 0%, #dc2626 45%, #991b1b 100%);
    color: rgba(255,255,255,0.85);
    padding: 90px 0 35px;
    margin-top: auto;
}

/* Glow effect */
.footer-undonet::before {
    content: '';
    position: absolute;
    width: 500px;
    height: 500px;
    background: rgba(255,255,255,0.08);
    border-radius: 50%;
    top: -250px;
    right: -150px;
    filter: blur(90px);
}

.footer-logo {
    font-size: 34px;
    font-weight: 900;
    color: white;
    margin-bottom: 16px;
    letter-spacing: -1px;
}

.footer-desc {
    line-height: 1.9;
    max-width: 340px;
    font-size: 15px;
    color: rgba(255,255,255,0.82);
}

.footer-undonet h6 {
    color: white;
    font-weight: 700;
    margin-bottom: 24px;
    font-size: 15px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 14px;
}

.footer-links a {
    color: rgba(255,255,255,0.78);
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 14px;
}

.footer-links a:hover {
    color: white;
    padding-left: 6px;
}

.footer-social a {
    width: 46px;
    height: 46px;
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(10px);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: 0.3s ease;
    font-size: 18px;
    border: 1px solid rgba(255,255,255,0.08);
}

.footer-social a:hover {
    transform: translateY(-5px);
    background: rgba(255,255,255,0.2);
}

.footer-contact p {
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: rgba(255,255,255,0.82);
}

.footer-contact i {
    color: white;
    font-size: 16px;
}

.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.12);
    margin-top: 60px;
    padding-top: 25px;
}

.footer-bottom p {
    color: rgba(255,255,255,0.75);
}

.footer-bottom a {
    color: rgba(255,255,255,0.75);
    text-decoration: none;
    transition: 0.3s ease;
}

.footer-bottom a:hover {
    color: white;
}
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-undonet">
        <div class="container px-lg-5">

            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('storage/logoperusahaanfaiziy.png') }}" alt="UNDONET Logo">
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="bi bi-list fs-2"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">

                <ul class="navbar-nav mx-auto nav-undonet">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}#home">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#about">Tentang</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#katalog">Paket</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#contact">Kontak</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">

                    @auth

                        @if(Auth::user()->role === 'pelanggan')

                            <a href="{{ route('pelanggan.keranjang') }}"
                               class="position-relative text-dark text-decoration-none">

                                <i class="bi bi-cart3" style="font-size:22px;"></i>

                                @php
                                    $jmlKeranjang = count(session()->get('keranjang', []));
                                @endphp

                                @if($jmlKeranjang > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                          style="font-size:9px;">
                                        {{ $jmlKeranjang }}
                                    </span>
                                @endif
                            </a>

                            <a href="{{ route('pelanggan.profil') }}"
                               class="text-dark text-decoration-none"
                               title="{{ Auth::user()->nama }}">

                                <i class="bi bi-person-circle" style="font-size:22px;"></i>
                            </a>

                        @endif

                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf

                            <button type="submit"
                                    class="text-dark border-0 bg-transparent p-0"
                                    title="Logout">

                                <i class="bi bi-box-arrow-right" style="font-size:22px;"></i>
                            </button>
                        </form>

                    @else

                        <a class="btn-login" href="{{ route('login') }}">
                            Login
                        </a>

                        <a class="btn-register" href="{{ route('register') }}">
                            Daftar
                        </a>

                    @endauth

                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer-undonet">

        <div class="container px-lg-5">

            <div class="row gy-5">

                <!-- Brand -->
                <div class="col-lg-4">

                    <h3 class="footer-logo">UNDONET</h3>

                    <p class="footer-desc">
                        Solusi internet cepat, stabil, dan modern untuk rumah serta bisnis Anda.
                    </p>

                    <div class="footer-social d-flex gap-3 mt-4">
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>

                </div>

                <!-- Menu -->
                <div class="col-6 col-lg-2">

                    <h6>Menu</h6>

                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Paket</a></li>
                        <li><a href="#">Coverage</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>

                </div>

                <!-- Bantuan -->
                <div class="col-6 col-lg-3">

                    <h6>Bantuan</h6>

                    <ul class="footer-links">
                        <li><a href="#">Pusat Bantuan</a></li>
                        <li><a href="#">Status Jaringan</a></li>
                        <li><a href="#">Pembayaran</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>

                </div>

                <!-- Contact -->
                <div class="col-lg-3">

                    <h6>Hubungi Kami</h6>

                    <div class="footer-contact">
                        <p>
                            <i class="bi bi-geo-alt"></i>
                            Cirebon, Indonesia
                        </p>

                        <p>
                            <i class="bi bi-envelope"></i>
                            support@undonet.id
                        </p>

                        <p>
                            <i class="bi bi-telephone"></i>
                            +62 812-xxxx-xxxx
                        </p>
                    </div>

                </div>
            </div>

            <div class="footer-bottom">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">

                    <p class="mb-0">
                        © {{ date('Y') }} UNDONET. All rights reserved.
                    </p>

                    <div class="d-flex gap-4">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                    </div>

                </div>

            </div>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>