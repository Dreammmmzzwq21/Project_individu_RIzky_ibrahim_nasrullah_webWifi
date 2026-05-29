@extends('layouts.app')

@section('title', 'UNDONET - Internet Fiber Cepat dan Stabil')

@section('content')

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            confirmButtonText: 'OK',
            confirmButtonColor: '#dc2626',
            width: '350px',
        });
    });
</script>
@endif

@if(session('keranjang_sukses'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("keranjang_sukses") }}',
            confirmButtonText: 'OK',
            confirmButtonColor: '#dc2626',
            width: '350px',
        });
    });
</script>
@endif

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

:root {
    --undonet-red: #dc2626;
    --undonet-red-dark: #991b1b;
    --undonet-ink: #111827;
    --undonet-muted: #64748b;
    --undonet-soft: #f8fafc;
    --undonet-line: #e5e7eb;
    --undonet-card: #ffffff;
}

html { scroll-behavior: smooth; }

.undonet-page {
    font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: var(--undonet-ink);
    background:
        radial-gradient(circle at top left, rgba(220,38,38,.10), transparent 26rem),
        linear-gradient(180deg, #fff 0%, #f8fafc 44%, #fff 100%);
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
    font-size: clamp(28px, 4vw, 44px);
    line-height: 1.05;
    font-weight: 900;
    letter-spacing: -.04em;
    color: var(--undonet-ink);
}

.section-sub {
    color: var(--undonet-muted);
    font-size: 15px;
    line-height: 1.8;
}

.hero-undonet {
    position: relative;
    overflow: hidden;
    padding: 92px 0 72px;
    background:
        linear-gradient(135deg, rgba(127,29,29,.96), rgba(220,38,38,.92) 44%, rgba(17,24,39,.98)),
        radial-gradient(circle at 80% 12%, rgba(255,255,255,.25), transparent 20rem);
    color: white;
}

.hero-undonet:before {
    content: '';
    position: absolute;
    inset: auto -12% -36% 40%;
    height: 520px;
    background: radial-gradient(circle, rgba(255,255,255,.16), transparent 60%);
    pointer-events: none;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    border: 1px solid rgba(255,255,255,.22);
    border-radius: 999px;
    background: rgba(255,255,255,.12);
    color: white;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
    backdrop-filter: blur(10px);
}

.hero-title {
    max-width: 720px;
    margin: 20px 0 18px;
    font-size: clamp(42px, 7vw, 76px);
    line-height: .98;
    font-weight: 900;
    letter-spacing: -.06em;
}

.hero-copy {
    max-width: 600px;
    color: rgba(255,255,255,.82);
    font-size: 17px;
    line-height: 1.8;
}

.btn-undonet-primary,
.btn-undonet-outline,
.btn-beli,
.btn-beli-outline {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border-radius: 999px;
    font-weight: 800;
    text-decoration: none;
    transition: .25s ease;
}

.btn-undonet-primary,
.btn-beli {
    border: 0;
    background: linear-gradient(135deg, #ef4444, #b91c1c);
    color: white;
    box-shadow: 0 18px 38px rgba(220,38,38,.28);
}

.btn-undonet-primary {
    padding: 14px 24px;
}

.btn-undonet-primary:hover,
.btn-beli:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 22px 44px rgba(220,38,38,.34);
}

.btn-undonet-outline {
    padding: 13px 22px;
    border: 1px solid rgba(255,255,255,.34);
    color: white;
    background: rgba(255,255,255,.08);
}

.btn-undonet-outline:hover {
    color: white;
    background: rgba(255,255,255,.16);
    transform: translateY(-2px);
}

.network-panel {
    position: relative;
    min-height: 430px;
    border: 1px solid rgba(255,255,255,.18);
    border-radius: 32px;
    background:
        linear-gradient(145deg, rgba(255,255,255,.18), rgba(255,255,255,.06)),
        repeating-linear-gradient(90deg, rgba(255,255,255,.08) 0 1px, transparent 1px 54px),
        repeating-linear-gradient(0deg, rgba(255,255,255,.08) 0 1px, transparent 1px 54px);
    box-shadow: 0 30px 80px rgba(0,0,0,.24);
    backdrop-filter: blur(14px);
    overflow: hidden;
}

.network-line {
    position: absolute;
    inset: 50% auto auto 18%;
    width: 64%;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,.78), transparent);
}

.network-node {
    position: absolute;
    width: 76px;
    height: 76px;
    border-radius: 22px;
    display: grid;
    place-items: center;
    color: white;
    background: rgba(255,255,255,.14);
    border: 1px solid rgba(255,255,255,.22);
    box-shadow: 0 18px 36px rgba(0,0,0,.18);
    animation: floatNode 4.5s ease-in-out infinite;
}

.network-node i { font-size: 30px; }
.network-node.n1 { left: 12%; top: 18%; }
.network-node.n2 { right: 14%; top: 22%; animation-delay: .8s; }
.network-node.n3 { left: 21%; bottom: 18%; animation-delay: 1.3s; }
.network-node.n4 { right: 24%; bottom: 16%; animation-delay: .4s; }

.speed-card {
    position: absolute;
    left: 50%;
    top: 50%;
    width: 190px;
    padding: 22px;
    border-radius: 28px;
    transform: translate(-50%, -50%);
    background: white;
    color: var(--undonet-ink);
    box-shadow: 0 30px 70px rgba(0,0,0,.24);
    text-align: center;
}

.speed-card .speed {
    font-size: 46px;
    line-height: 1;
    font-weight: 900;
    letter-spacing: -.05em;
    color: var(--undonet-red);
}

.speed-card .speed span {
    font-size: 15px;
    letter-spacing: 0;
    color: var(--undonet-muted);
}

@keyframes floatNode {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.trust-strip {
    position: relative;
    z-index: 3;
    margin-top: -34px;
}

.trust-card,
.produk-card,
.value-card,
.info-card,
.contact-box,
.map-shell,
.faq-shell {
    background: var(--undonet-card);
    border: 1px solid rgba(226,232,240,.9);
    box-shadow: 0 18px 50px rgba(15,23,42,.08);
}

.trust-card {
    height: 100%;
    padding: 24px;
    border-radius: 22px;
    transition: .25s ease;
}

.trust-card:hover,
.produk-card:hover,
.value-card:hover,
.info-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 24px 60px rgba(15,23,42,.12);
}

.trust-icon,
.value-icon,
.info-icon {
    width: 50px;
    height: 50px;
    border-radius: 16px;
    display: grid;
    place-items: center;
    background: #fff1f2;
    color: var(--undonet-red);
    font-size: 23px;
}

.katalog-section,
.about-section,
.contact-section {
    padding: 92px 0;
}

.katalog-section { background: #f8fafc; }
.about-section { background: white; }
.contact-section { background: #f8fafc; }

.catalog-toolbar {
    padding: 22px;
    border-radius: 26px;
    background: white;
    border: 1px solid var(--undonet-line);
    box-shadow: 0 14px 40px rgba(15,23,42,.06);
}

.search-pill {
    min-height: 44px;
    padding: 6px 14px;
    border-radius: 999px;
    background: #f8fafc;
    border: 1px solid var(--undonet-line);
}

.search-pill input {
    border: 0;
    outline: 0;
    background: transparent;
    width: 170px;
    font-size: 13px;
}

.filter-btn {
    display: inline-flex;
    align-items: center;
    min-height: 40px;
    padding: 8px 16px;
    border-radius: 999px;
    border: 1px solid var(--undonet-line);
    background: white;
    color: #475569;
    font-size: 13px;
    font-weight: 800;
    text-decoration: none;
    transition: .2s ease;
}

.filter-btn:hover,
.filter-btn.aktif {
    color: white;
    border-color: var(--undonet-red);
    background: var(--undonet-red);
}

.produk-card {
    height: 100%;
    border-radius: 24px;
    overflow: hidden;
    transition: .25s ease;
}

.produk-img-wrap {
    height: 190px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background:
        radial-gradient(circle at 30% 20%, rgba(220,38,38,.16), transparent 12rem),
        linear-gradient(135deg, #fff, #f1f5f9);
}

.produk-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.produk-img-wrap .icon-fallback {
    font-size: 76px;
    color: #fecaca;
}

.badge-kat {
    display: inline-flex;
    align-items: center;
    padding: 5px 11px;
    border-radius: 999px;
    background: #fff1f2;
    color: var(--undonet-red);
    font-size: 11px;
    font-weight: 800;
}

.harga {
    color: var(--undonet-red);
    font-size: 20px;
    font-weight: 900;
    letter-spacing: -.03em;
}

.stok {
    color: var(--undonet-muted);
    font-size: 11px;
    font-weight: 700;
}

.btn-beli,
.btn-beli-outline,
.stok-habis,
.btn-detail {
    width: 100%;
    min-height: 42px;
    padding: 10px 14px;
    border-radius: 14px;
    font-size: 13px;
}

.btn-beli-outline {
    color: var(--undonet-red);
    border: 1px solid #fecaca;
    background: #fff1f2;
}

.btn-beli-outline:hover {
    color: white;
    border-color: var(--undonet-red);
    background: var(--undonet-red);
}

.stok-habis {
    border: 0;
    color: #94a3b8;
    background: #f1f5f9;
    font-weight: 800;
    cursor: not-allowed;
}

.btn-detail {
    margin-top: 8px;
    border: 0;
    color: var(--undonet-red);
    background: #fff7f7;
    font-weight: 800;
    transition: .2s ease;
}

.btn-detail:hover { background: #fee2e2; }

.stat-card {
    height: 100%;
    padding: 26px 18px;
    border-radius: 22px;
    background: #fff;
    border: 1px solid var(--undonet-line);
    box-shadow: 0 14px 34px rgba(15,23,42,.06);
    text-align: center;
}

.stat-number {
    color: var(--undonet-red);
    font-size: 34px;
    font-weight: 900;
    letter-spacing: -.05em;
}

.stat-label {
    color: var(--undonet-muted);
    font-size: 13px;
    font-weight: 700;
}

.fiber-visual {
    min-height: 390px;
    border-radius: 30px;
    background:
        radial-gradient(circle at 28% 28%, rgba(220,38,38,.20), transparent 13rem),
        linear-gradient(135deg, #111827, #7f1d1d);
    position: relative;
    overflow: hidden;
}

.fiber-visual:before,
.fiber-visual:after {
    content: '';
    position: absolute;
    width: 70%;
    height: 2px;
    left: 15%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,.74), transparent);
    transform: rotate(-18deg);
}

.fiber-visual:before { top: 36%; }
.fiber-visual:after { bottom: 34%; transform: rotate(18deg); }

.fiber-router {
    position: absolute;
    inset: 50% auto auto 50%;
    transform: translate(-50%, -50%);
    width: 160px;
    height: 120px;
    border-radius: 28px;
    background: white;
    color: var(--undonet-red);
    display: grid;
    place-items: center;
    box-shadow: 0 28px 70px rgba(0,0,0,.28);
}

.fiber-router i { font-size: 54px; }

.value-card,
.info-card {
    height: 100%;
    padding: 30px;
    border-radius: 24px;
    transition: .25s ease;
}

.contact-hero {
    border-radius: 32px;
    padding: 64px 36px 96px;
    color: white;
    text-align: center;
    background: linear-gradient(135deg, #111827, #991b1b 56%, #dc2626);
}

.info-grid {
    margin-top: -62px;
    position: relative;
    z-index: 2;
}

.map-shell {
    border-radius: 26px;
    overflow: hidden;
}

.faq-shell {
    border-radius: 24px;
    overflow: hidden;
}

.accordion-button {
    font-weight: 800;
    color: var(--undonet-ink);
    font-size: 15px;
}

.accordion-button:not(.collapsed) {
    color: var(--undonet-red);
    background: #fff1f2;
    box-shadow: none;
}

.accordion-button:focus { box-shadow: none; }
.accordion-item { border-color: var(--undonet-line); }
.accordion-body { color: #475569; font-size: 14px; line-height: 1.8; }
.swal2-border-radius { border-radius: 22px !important; }

@media (max-width: 991.98px) {
    .hero-undonet { padding: 72px 0 56px; }
    .network-panel { min-height: 340px; margin-top: 34px; }
    .trust-strip { margin-top: 28px; }
}

@media (max-width: 575.98px) {
    .katalog-section,
    .about-section,
    .contact-section { padding: 70px 0; }
    .catalog-toolbar { padding: 18px; }
    .search-pill { width: 100%; }
    .search-pill input { width: 100%; }
    .produk-img-wrap { height: 150px; }
    .value-card,
    .info-card { padding: 22px; }
    .contact-hero { padding: 48px 22px 90px; }
}
</style>

<main class="undonet-page">
    <section id="home" class="hero-undonet" style="scroll-margin-top:62px;">
        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <div class="hero-badge"><i class="bi bi-broadcast-pin"></i> UNDONET Fiber Network</div>
                    <h1 class="hero-title">Internet cepat, stabil, dan siap untuk rumah modern.</h1>
                    <p class="hero-copy">UNDONET menghadirkan koneksi fiber premium untuk streaming, gaming, meeting, belajar, dan bisnis rumahan dengan instalasi rapi serta dukungan teknis responsif.</p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="#katalog" class="btn-undonet-primary"><i class="bi bi-router"></i>Cek Paket Internet</a>
                        <a href="#contact" class="btn-undonet-outline"><i class="bi bi-geo-alt"></i>Cek Coverage Area</a>
                    </div>
                    <div class="d-flex flex-wrap gap-4 mt-5">
                        <div><div class="fw-black" style="font-size:28px;font-weight:900;">99%</div><div style="color:rgba(255,255,255,.72);font-size:13px;">Stabilitas jaringan</div></div>
                        <div><div class="fw-black" style="font-size:28px;font-weight:900;">24/7</div><div style="color:rgba(255,255,255,.72);font-size:13px;">Monitoring teknis</div></div>
                        <div><div class="fw-black" style="font-size:28px;font-weight:900;">1 Hari</div><div style="color:rgba(255,255,255,.72);font-size:13px;">Estimasi instalasi</div></div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="network-panel">
                        <div class="network-line"></div>
                        <div class="network-node n1"><i class="bi bi-phone"></i></div>
                        <div class="network-node n2"><i class="bi bi-pc-display"></i></div>
                        <div class="network-node n3"><i class="bi bi-tv"></i></div>
                        <div class="network-node n4"><i class="bi bi-controller"></i></div>
                        <div class="speed-card">
                            <div class="speed">100<span>Mbps</span></div>
                            <div style="font-size:12px;color:#64748b;font-weight:800;margin-top:8px;">fiber ready</div>
                            <div class="mt-3" style="height:8px;border-radius:999px;background:#fee2e2;overflow:hidden;">
                                <div style="width:86%;height:100%;background:linear-gradient(90deg,#ef4444,#b91c1c);border-radius:999px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="trust-strip container">
        <div class="row g-3">
            <div class="col-6 col-lg-3">
                <div class="trust-card">
                    <div class="trust-icon mb-3"><i class="bi bi-lightning-charge"></i></div>
                    <h5 class="fw-bold mb-1">Fiber Stabil</h5>
                    <p class="section-sub mb-0" style="font-size:13px;">Koneksi kencang untuk semua perangkat di rumah.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="trust-card">
                    <div class="trust-icon mb-3"><i class="bi bi-tools"></i></div>
                    <h5 class="fw-bold mb-1">Instalasi Rapi</h5>
                    <p class="section-sub mb-0" style="font-size:13px;">Teknisi membantu pemasangan sampai siap pakai.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="trust-card">
                    <div class="trust-icon mb-3"><i class="bi bi-headset"></i></div>
                    <h5 class="fw-bold mb-1">Support Cepat</h5>
                    <p class="section-sub mb-0" style="font-size:13px;">Bantuan pelanggan untuk gangguan dan konsultasi.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="trust-card">
                    <div class="trust-icon mb-3"><i class="bi bi-shield-check"></i></div>
                    <h5 class="fw-bold mb-1">Transparan</h5>
                    <p class="section-sub mb-0" style="font-size:13px;">Paket jelas, harga jelas, tanpa gimmick rumit.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="katalog" class="katalog-section" style="scroll-margin-top:62px;">
        <div class="container">
            <div class="catalog-toolbar d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <span class="section-kicker">Paket Internet</span>
                    <h2 class="section-title mt-3 mb-2">Pilih paket UNDONET.</h2>
                    <div class="section-sub">
                        {{ $produk->count() }} paket tersedia
                        @if($kategori) untuk kategori <strong>{{ $kategori }}</strong>
                        @elseif(!empty($cari)) hasil pencarian "<strong>{{ $cari }}</strong>"
                        @endif
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <form action="{{ route('search') }}" method="GET" class="search-pill d-flex align-items-center gap-2">
                        <i class="bi bi-search text-secondary" style="font-size:14px;"></i>
                        <input type="text" name="q" value="{{ $cari ?? '' }}" placeholder="Cari paket...">
                        @if(!empty($cari))
                            <a href="{{ route('home') }}#katalog" style="color:#94a3b8;font-size:16px;text-decoration:none;">x</a>
                        @endif
                    </form>
                    <a href="{{ route('home') }}#katalog" class="filter-btn {{ !$kategori && empty($cari) ? 'aktif' : '' }}">Semua</a>
                    @foreach($kategoris as $kat)
                        <a href="{{ route('pelanggan.index', ['kategori'=>$kat->kategori]) }}#katalog" class="filter-btn {{ $kategori==$kat->kategori ? 'aktif' : '' }}">{{ $kat->kategori }}</a>
                    @endforeach
                </div>
            </div>

            @if($produk->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-router fs-1 d-block mb-3 text-secondary"></i>
                    <h5>Paket belum tersedia</h5>
                    <p class="mb-0">Silakan cek kategori lain atau hubungi tim UNDONET.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach($produk as $p)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="produk-card d-flex flex-column">
                            <a href="{{ route('pelanggan.index', ['kategori'=>$p->kategori]) }}#katalog" class="d-block text-decoration-none">
                                <div class="produk-img-wrap position-relative">
                                    @if($p->poto)
                                        <img src="{{ asset('storage/'.$p->poto) }}" alt="{{ $p->nama }}">
                                    @else
                                        <i class="bi bi-router icon-fallback"></i>
                                    @endif
                                    @if($p->stok == 0)
                                        <div style="position:absolute;top:12px;right:12px;background:rgba(17,24,39,.72);color:white;font-size:10px;font-weight:800;padding:5px 10px;border-radius:999px;">Tidak tersedia</div>
                                    @elseif($p->stok <= 3)
                                        <div style="position:absolute;top:12px;right:12px;background:#dc2626;color:white;font-size:10px;font-weight:800;padding:5px 10px;border-radius:999px;">Slot {{ $p->stok }}</div>
                                    @endif
                                </div>
                            </a>

                            <div class="p-3 d-flex flex-column flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center gap-2 mb-2">
                                    <span class="badge-kat">{{ $p->kategori }}</span>
                                    <span style="font-size:10px;color:#64748b;font-weight:700;"><i class="bi bi-wifi text-danger me-1"></i>Fiber</span>
                                </div>

                                <h3 class="mb-2" style="font-size:15px;line-height:1.35;color:#0f172a;font-weight:900;">{{ $p->nama }}</h3>
                                <p class="text-muted mb-3" style="font-size:12px;line-height:1.6;">{{ Str::limit($p->deskripsi, 90) }}</p>

                                @php
                                    $spek = $p->spesifikasi ?? '';
                                    $specs = array_filter(array_map('trim', explode(',', $spek)));
                                @endphp
                                @if(!empty($specs))
                                    <div class="d-flex flex-wrap gap-1 mb-3">
                                        @foreach(array_slice($specs, 0, 3) as $s)
                                            <span style="background:#f8fafc;color:#475569;font-size:10px;padding:4px 8px;border-radius:999px;font-weight:800;border:1px solid #e5e7eb;">{{ $s }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="d-flex flex-wrap gap-3 mb-3">
                                    @if(isset($p->layar) && $p->layar)
                                        <div style="font-size:11px;color:#64748b;"><i class="bi bi-speedometer2 me-1"></i>{{ $p->layar }} Mbps</div>
                                    @endif
                                    @if(isset($p->berat) && $p->berat)
                                        <div style="font-size:11px;color:#64748b;"><i class="bi bi-router me-1"></i>{{ $p->berat }} router</div>
                                    @endif
                                </div>

                                <div class="d-flex align-items-center gap-1 mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill" style="font-size:11px;color:{{ $i <= ($p->rating ?? 4) ? '#f59e0b' : '#e2e8f0' }};"></i>
                                    @endfor
                                    <span style="font-size:11px;color:#64748b;margin-left:4px;">{{ number_format($p->rating ?? 4, 1) }} / 5.0</span>
                                </div>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center gap-2 mb-3">
                                        <div>
                                            <div class="harga">Rp {{ number_format($p->harga,0,',','.') }}</div>
                                            <div style="font-size:11px;color:#64748b;">per bulan</div>
                                        </div>
                                        <div class="stok">
                                            @if($p->stok > 3)
                                                <i class="bi bi-check-circle-fill text-success me-1"></i>Tersedia
                                            @elseif($p->stok > 0)
                                                <span style="color:#dc2626;font-weight:800;">Slot {{ $p->stok }}</span>
                                            @else
                                                <span style="color:#94a3b8;">Penuh</span>
                                            @endif
                                        </div>
                                    </div>

                                    @if($p->stok > 0)
                                        @auth
                                            <form action="{{ route('pelanggan.keranjang.tambah') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_produk" value="{{ $p->id }}">
                                                <input type="hidden" name="jumlah" value="1">
                                                <button type="submit" class="btn-beli"><i class="bi bi-cart-plus"></i>Pilih Paket</button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="btn-beli-outline"><i class="bi bi-box-arrow-in-right"></i>Login untuk Pilih</a>
                                        @endauth
                                    @else
                                        <button class="stok-habis" disabled><i class="bi bi-x-circle me-1"></i>Slot Penuh</button>
                                    @endif

                                    <button type="button"
                                        onclick="lihatDetail('{{ addslashes($p->nama) }}', '{{ addslashes($p->deskripsi) }}', '{{ $p->kategori }}', '{{ number_format($p->harga,0,',','.') }}', '{{ $p->stok }}', '{{ $p->rating ?? 4 }}', '{{ asset('storage/'.$p->poto) }}')"
                                        class="btn-detail">
                                        <i class="bi bi-info-circle me-1"></i>Lihat Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section id="about" class="about-section" style="scroll-margin-top:62px;">
        <div class="container">
            <div class="row align-items-center g-5 mb-5">
                <div class="col-lg-6">
                    <span class="section-kicker">Tentang UNDONET</span>
                    <h2 class="section-title mt-3 mb-3">Dibangun untuk koneksi harian yang lebih tenang.</h2>
                    <p class="section-sub">UNDONET adalah penyedia layanan internet fiber untuk rumah, pelajar, kreator, gamer, dan UMKM. Fokus kami sederhana: koneksi stabil, paket mudah dipahami, instalasi cepat, dan layanan pelanggan yang manusiawi.</p>
                    <div class="row g-3 mt-4">
                        <div class="col-6 col-md-4"><div class="stat-card"><div class="stat-number">500+</div><div class="stat-label">Pelanggan aktif</div></div></div>
                        <div class="col-6 col-md-4"><div class="stat-card"><div class="stat-number">99%</div><div class="stat-label">Uptime jaringan</div></div></div>
                        <div class="col-6 col-md-4"><div class="stat-card"><div class="stat-number">24/7</div><div class="stat-label">Monitoring</div></div></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fiber-visual">
                        <div class="fiber-router"><i class="bi bi-router"></i></div>
                    </div>
                </div>
            </div>

            <div class="text-center mb-5">
                <span class="section-kicker">Kenapa Pilih Kami</span>
                <h2 class="section-title mt-3 mb-0">Internet premium tanpa ribet.</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4"><div class="value-card"><div class="value-icon mb-3"><i class="bi bi-speedometer2"></i></div><h5 class="fw-bold">Kecepatan Konsisten</h5><p class="section-sub mb-0">Paket dirancang untuk penggunaan nyata: streaming, meeting, gaming, dan upload kerja harian.</p></div></div>
                <div class="col-md-4"><div class="value-card"><div class="value-icon mb-3"><i class="bi bi-cash-coin"></i></div><h5 class="fw-bold">Harga Transparan</h5><p class="section-sub mb-0">Informasi paket dibuat jelas agar pelanggan mudah membandingkan kebutuhan dan budget.</p></div></div>
                <div class="col-md-4"><div class="value-card"><div class="value-icon mb-3"><i class="bi bi-headset"></i></div><h5 class="fw-bold">Support Responsif</h5><p class="section-sub mb-0">Tim kami siap membantu pengecekan jaringan, konsultasi paket, dan kendala teknis.</p></div></div>
                <div class="col-md-4"><div class="value-card"><div class="value-icon mb-3"><i class="bi bi-house-check"></i></div><h5 class="fw-bold">Instalasi Terarah</h5><p class="section-sub mb-0">Proses pemasangan dilakukan rapi dengan pengecekan sinyal sebelum layanan digunakan.</p></div></div>
                <div class="col-md-4"><div class="value-card"><div class="value-icon mb-3"><i class="bi bi-shield-lock"></i></div><h5 class="fw-bold">Jaringan Aman</h5><p class="section-sub mb-0">Konfigurasi jaringan dibuat stabil dan aman untuk perangkat keluarga maupun bisnis kecil.</p></div></div>
                <div class="col-md-4"><div class="value-card"><div class="value-icon mb-3"><i class="bi bi-graph-up-arrow"></i></div><h5 class="fw-bold">Siap Upgrade</h5><p class="section-sub mb-0">Butuh speed lebih tinggi? Paket dapat disesuaikan ketika kebutuhan internet bertambah.</p></div></div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact-section" style="scroll-margin-top:62px;">
        <div class="container">
            <div class="contact-hero">
                <span class="hero-badge"><i class="bi bi-chat-dots"></i>Hubungi Kami</span>
                <h2 class="section-title mt-3 mb-3" style="color:white;">Cek coverage dan konsultasi paket.</h2>
                <p style="max-width:620px;margin:0 auto;color:rgba(255,255,255,.82);line-height:1.8;">Tim UNDONET siap membantu pengecekan area, rekomendasi paket, status pemasangan, dan pertanyaan seputar layanan internet fiber.</p>
            </div>

            <div class="row g-4 info-grid mb-5">
                <div class="col-6 col-lg-3"><div class="info-card text-center"><div class="info-icon mx-auto mb-3"><i class="bi bi-whatsapp"></i></div><h6 class="fw-bold">WhatsApp</h6><p class="mb-1"><a href="https://wa.me/62882000500593" target="_blank" style="color:#16a34a;text-decoration:none;font-weight:800;">0882-0005-00593</a></p><p class="section-sub mb-0" style="font-size:12px;">Senin-Sabtu, 09.00-21.00</p></div></div>
                <div class="col-6 col-lg-3"><div class="info-card text-center"><div class="info-icon mx-auto mb-3"><i class="bi bi-envelope"></i></div><h6 class="fw-bold">Email</h6><p class="mb-1" style="word-break:break-all;"><a href="mailto:hello@undonet.id" style="color:#dc2626;text-decoration:none;font-weight:800;">hello@undonet.id</a></p><p class="section-sub mb-0" style="font-size:12px;">Balasan maksimal 1x24 jam</p></div></div>
                <div class="col-6 col-lg-3"><div class="info-card text-center"><div class="info-icon mx-auto mb-3"><i class="bi bi-instagram"></i></div><h6 class="fw-bold">Instagram</h6><p class="mb-1"><a href="https://instagram.com/undonet.id" target="_blank" style="color:#dc2626;text-decoration:none;font-weight:800;">@undonet.id</a></p><p class="section-sub mb-0" style="font-size:12px;">Promo dan info jaringan</p></div></div>
                <div class="col-6 col-lg-3"><div class="info-card text-center"><div class="info-icon mx-auto mb-3"><i class="bi bi-geo-alt"></i></div><h6 class="fw-bold">Coverage</h6><p class="mb-1" style="font-size:13px;font-weight:800;color:#0f172a;">Cirebon dan sekitar</p><p class="section-sub mb-0" style="font-size:12px;">Cek area sebelum daftar</p></div></div>
            </div>

            <div class="map-shell mb-5">
                <div class="row g-0">
                    <div class="col-lg-8">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.888227317215!2d108.54830731533906!3d-6.718441995169233!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ef5b6b1234567%3A0xabc123!2sJl.+Perjuangan%2C+Kesambi%2C+Kota+Cirebon%2C+Jawa+Barat!5e0!3m2!1sid!2sid!4v1716000000000!5m2!1sid!2sid"
                            width="100%" height="340" style="border:0;display:block;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                    <div class="col-lg-4 p-4 p-lg-5" style="background:#fff;">
                        <span class="section-kicker">Lokasi</span>
                        <h3 class="fw-bold mt-3">UNDONET Service Point</h3>
                        <p class="section-sub">Jl. Perjuangan, Kesambi, Kota Cirebon, Jawa Barat.</p>
                        <div class="d-flex gap-3 mb-3"><i class="bi bi-clock-fill text-success"></i><div><strong>Senin-Sabtu</strong><br><span class="section-sub">09.00-21.00 WIB</span></div></div>
                        <div class="d-flex gap-3 mb-4"><i class="bi bi-envelope-fill text-danger"></i><div><strong>Email</strong><br><span class="section-sub">hello@undonet.id</span></div></div>
                        <a href="https://wa.me/62882000500593" target="_blank" class="btn-undonet-primary w-100"><i class="bi bi-whatsapp"></i>Chat WhatsApp</a>
                    </div>
                </div>
            </div>

            <div class="text-center mb-4">
                <span class="section-kicker">FAQ</span>
                <h2 class="section-title mt-3 mb-0">Pertanyaan yang sering diajukan.</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-shell">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">Bagaimana cara cek area UNDONET?</button></h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion"><div class="accordion-body">Hubungi tim kami lewat WhatsApp dan kirim alamat lengkap. Tim UNDONET akan membantu cek coverage serta rekomendasi paket yang tersedia di area Anda.</div></div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">Berapa lama proses instalasi?</button></h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body">Estimasi instalasi umumnya 1-3 hari kerja setelah data pelanggan dan jadwal teknisi dikonfirmasi, tergantung ketersediaan jaringan di lokasi.</div></div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">Metode pembayaran apa saja yang diterima?</button></h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body">Pembayaran dapat mengikuti metode yang tersedia di sistem, termasuk transfer bank dan metode digital yang didukung.</div></div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">Apakah paket bisa di-upgrade?</button></h2>
                                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body">Bisa. Pelanggan dapat mengajukan upgrade paket sesuai kebutuhan dan ketersediaan layanan di area pemasangan.</div></div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">Apakah ada bantuan jika jaringan bermasalah?</button></h2>
                                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body">Tentu. Tim support UNDONET akan membantu pengecekan awal dan meneruskan ke teknisi jika diperlukan.</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function lihatDetail(nama, deskripsi, kategori, harga, stok, rating, foto) {
    const nilaiRating = Number(rating) || 4;
    const bintang = Array.from({length: 5}, (_, i) =>
        `<i class="bi bi-star-fill" style="color:${i < nilaiRating ? '#f59e0b' : '#e2e8f0'};font-size:13px;"></i>`
    ).join('');

    const stokBadge = stok > 3
        ? `<span style="background:#dcfce7;color:#16a34a;padding:5px 12px;border-radius:999px;font-size:11px;font-weight:800;">Tersedia (${stok} slot)</span>`
        : stok > 0
        ? `<span style="background:#fef3c7;color:#b45309;padding:5px 12px;border-radius:999px;font-size:11px;font-weight:800;">Sisa ${stok} slot</span>`
        : `<span style="background:#fee2e2;color:#dc2626;padding:5px 12px;border-radius:999px;font-size:11px;font-weight:800;">Slot penuh</span>`;

    Swal.fire({
        html: `
            <div style="text-align:left;font-family:Inter,system-ui,sans-serif;">
                <img src="${foto}" onerror="this.style.display='none'"
                    style="width:100%;height:190px;object-fit:cover;background:#f8fafc;border-radius:18px;margin-bottom:18px;">
                <div style="margin-bottom:12px;">
                    <span style="background:#fff1f2;color:#dc2626;padding:5px 12px;border-radius:999px;font-size:11px;font-weight:800;">${kategori}</span>
                </div>
                <h3 style="font-size:20px;font-weight:900;color:#111827;margin:0 0 8px;letter-spacing:-.03em;">${nama}</h3>
                <div style="margin-bottom:12px;">${bintang} <span style="font-size:12px;color:#64748b;margin-left:4px;">${nilaiRating.toFixed(1)}/5.0</span></div>
                <p style="font-size:13px;color:#475569;line-height:1.8;margin-bottom:16px;">${deskripsi}</p>
                <hr style="border:none;border-top:1px solid #e5e7eb;margin:12px 0;">
                <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
                    <div>
                        <div style="font-size:22px;font-weight:900;color:#dc2626;">Rp ${harga}</div>
                        <div style="font-size:11px;color:#64748b;">per bulan</div>
                    </div>
                    ${stokBadge}
                </div>
                <div style="margin-top:14px;padding:12px 14px;background:#f8fafc;border-radius:14px;font-size:12px;color:#64748b;line-height:1.7;">
                    <i class="bi bi-wifi text-danger me-1"></i> Fiber internet
                    &nbsp;|&nbsp; <i class="bi bi-tools me-1"></i> Instalasi teknisi
                    &nbsp;|&nbsp; <i class="bi bi-headset me-1"></i> Support pelanggan
                </div>
            </div>`,
        showConfirmButton: false,
        showCloseButton: true,
        width: '430px',
        customClass: { popup: 'swal2-border-radius' },
    });
}
</script>

@endsection
