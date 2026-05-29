@extends('layouts.app')

@section('title', 'Admin - UNDONET')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    header, nav.navbar, footer, .main-header, .main-footer, aside.main-sidebar {
        display: none !important;
    }

    #app, main, .py-4, .content-wrapper {
        padding: 0 !important;
        margin: 0 !important;
        background: none !important;
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
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--undonet-ink);
        margin: 0;
        padding-top: 80px;
    }

    .admin-navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 80px;
        z-index: 2000;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #111827, #7f1d1d 58%, #dc2626);
        box-shadow: 0 8px 24px rgba(15,23,42,.18);
    }

    .admin-navbar .inner {
        width: min(1440px, 100%);
        margin: 0 auto;
        padding: 0 28px;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .brand {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: white;
        font-weight: 900;
        letter-spacing: -.06em;
        font-size: 22px;
        flex-shrink: 0;
    }

    .brand span {
        color: #fecaca;
    }

    .nav-pills {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-left: 10px;
        flex: 1;
    }

    .nav-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 42px;
        padding: 10px 16px;
        border-radius: 999px;
        color: rgba(255,255,255,.72);
        text-decoration: none;
        font-size: 13px;
        font-weight: 800;
        border: 1px solid transparent;
        transition: .2s ease;
    }

    .nav-pill:hover {
        color: white;
        background: rgba(255,255,255,.08);
        border-color: rgba(255,255,255,.12);
    }

    .nav-pill.active {
        color: white;
        background: rgba(255,255,255,.14);
        border-color: rgba(255,255,255,.16);
        box-shadow: inset 0 0 0 1px rgba(255,255,255,.08);
    }

    .logout-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 14px;
        border: 0;
        background: rgba(255,255,255,.12);
        color: white;
        transition: .2s ease;
    }

    .logout-btn:hover {
        background: rgba(255,255,255,.2);
        transform: translateY(-1px);
    }

    .page-shell {
        width: min(1440px, 100%);
        margin: 0 auto;
        padding: 34px 28px 56px;
    }

    .hero-card,
    .section-card,
    .stat-card,
    .product-card,
    .table-card,
    .modal-content {
        background: var(--undonet-card);
        border: 1px solid rgba(226,232,240,.95);
        box-shadow: 0 18px 50px rgba(15,23,42,.08);
    }

    .hero-card {
        border-radius: 30px;
        padding: 28px;
        margin-bottom: 24px;
        background:
            linear-gradient(135deg, rgba(127,29,29,.98), rgba(220,38,38,.94) 48%, rgba(17,24,39,.98));
        color: white;
        overflow: hidden;
        position: relative;
    }

    .hero-card::before {
        content: '';
        position: absolute;
        inset: auto -10% -30% 45%;
        height: 320px;
        background: radial-gradient(circle, rgba(255,255,255,.16), transparent 60%);
        pointer-events: none;
    }

    .hero-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.16);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        backdrop-filter: blur(10px);
    }

    .hero-title {
        margin: 18px 0 10px;
        font-size: clamp(30px, 4vw, 46px);
        line-height: 1.02;
        font-weight: 900;
        letter-spacing: -.05em;
    }

    .hero-sub {
        margin: 0;
        max-width: 760px;
        color: rgba(255,255,255,.82);
        line-height: 1.8;
        font-size: 15px;
    }

    .hero-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 22px;
    }

    .hero-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 38px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.14);
        font-size: 12px;
        font-weight: 800;
    }

    .section-head {
        display: flex;
        justify-content: space-between;
        align-items: end;
        gap: 18px;
        margin-bottom: 18px;
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
        margin: 14px 0 0;
        font-size: clamp(26px, 3vw, 36px);
        line-height: 1.05;
        font-weight: 900;
        letter-spacing: -.05em;
        color: var(--undonet-ink);
    }

    .section-sub {
        margin-top: 8px;
        color: var(--undonet-muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .stat-card {
        height: 100%;
        border-radius: 24px;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: .22s ease;
    }

    .stat-card:hover,
    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 24px 60px rgba(15,23,42,.12);
    }

    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        font-size: 22px;
        color: var(--undonet-red);
        background: #fff1f2;
        flex-shrink: 0;
    }

    .stat-label {
        color: var(--undonet-muted);
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .stat-value {
        color: var(--undonet-ink);
        font-size: 28px;
        font-weight: 900;
        letter-spacing: -.05em;
        line-height: 1;
    }

    .stat-sub {
        color: var(--undonet-muted);
        font-size: 12px;
        font-weight: 700;
        margin-top: 6px;
    }

    .section-card,
    .table-card {
        border-radius: 28px;
        overflow: hidden;
        margin-bottom: 24px;
    }

    .card-head {
        padding: 22px 24px;
        border-bottom: 1px solid var(--undonet-line);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }

    .card-head h5,
    .card-head h6 {
        margin: 0;
        font-weight: 900;
        letter-spacing: -.04em;
        color: var(--undonet-ink);
    }

    .card-head p {
        margin: 4px 0 0;
        color: var(--undonet-muted);
        font-size: 13px;
    }

    .btn-undonet-outline,
    .btn-undonet-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        padding: 10px 16px;
        border-radius: 14px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        transition: .2s ease;
    }

    .btn-undonet-outline {
        color: var(--undonet-ink);
        border: 1px solid var(--undonet-line);
        background: white;
    }

    .btn-undonet-outline:hover {
        color: var(--undonet-red);
        border-color: #fecaca;
        background: #fff7f7;
    }

    .btn-undonet-primary {
        color: white;
        border: 0;
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        box-shadow: 0 18px 38px rgba(220,38,38,.24);
    }

    .btn-undonet-primary:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 22px 44px rgba(220,38,38,.30);
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

    .product-toolbar {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
    }

    .badge-soft {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 999px;
        background: #fff1f2;
        color: var(--undonet-red);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .product-table thead th {
        background: #f8fafc;
        color: var(--undonet-muted);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
        padding: 16px 18px;
        border-bottom: 1px solid var(--undonet-line);
    }

    .product-table tbody td {
        padding: 18px;
        border-bottom: 1px solid #f8fafc;
        vertical-align: middle;
        font-size: 14px;
    }

    .product-table tbody tr:last-child td {
        border-bottom: none;
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .product-thumb,
    .thumb-placeholder {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        flex-shrink: 0;
        object-fit: cover;
    }

    .thumb-placeholder {
        display: grid;
        place-items: center;
        background: #fff1f2;
        color: var(--undonet-red);
        font-size: 20px;
    }

    .product-name {
        font-weight: 900;
        color: var(--undonet-ink);
        margin-bottom: 3px;
    }

    .product-id {
        font-size: 12px;
        color: var(--undonet-muted);
        font-weight: 700;
    }

    .badge-kat,
    .badge-in,
    .badge-out {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
    }

    .badge-kat {
        background: #fff1f2;
        color: var(--undonet-red);
    }

    .badge-in {
        background: #dcfce7;
        color: #16a34a;
    }

    .badge-out {
        background: #fee2e2;
        color: #dc2626;
    }

    .text-desc {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
        color: var(--undonet-muted);
        font-size: 13px;
        line-height: 1.6;
        max-width: 240px;
    }

    .price {
        color: var(--undonet-red);
        font-weight: 900;
        letter-spacing: -.03em;
    }

    .btn-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--undonet-line);
        background: white;
        color: var(--undonet-muted);
        transition: .2s ease;
    }

    .btn-icon:hover {
        color: var(--undonet-red);
        border-color: #fecaca;
        background: #fff7f7;
    }

    .btn-icon-danger:hover {
        color: #dc2626;
        background: #fef2f2;
    }

    .modal-content {
        border-radius: 24px;
        overflow: hidden;
    }

    .modal-header,
    .modal-footer {
        border-color: var(--undonet-line);
    }

    .modal-title {
        font-weight: 900;
        letter-spacing: -.04em;
        color: var(--undonet-ink);
    }

    .alert-soft {
        border-radius: 18px;
        border: 1px solid #fecaca;
        background: #fff1f2;
        color: #b91c1c;
    }

    .swal2-popup {
        border-radius: 24px !important;
        font-family: 'Inter', system-ui, sans-serif !important;
    }

    @media (max-width: 991.98px) {
        body {
            padding-top: 132px;
        }

        .admin-navbar {
            height: auto;
            min-height: 80px;
            padding: 10px 0;
        }

        .admin-navbar .inner {
            flex-wrap: wrap;
        }

        .nav-pills {
            width: 100%;
            margin-left: 0;
        }

        .page-shell {
            padding: 24px 16px 48px;
        }

        .section-head {
            flex-direction: column;
            align-items: start;
        }
    }

    @media (max-width: 575.98px) {
        .hero-card,
        .section-card,
        .table-card {
            border-radius: 22px;
        }

        .hero-card {
            padding: 22px;
        }

        .stat-card {
            padding: 18px;
        }

        .card-head {
            padding: 18px;
        }

        .product-table tbody td,
        .product-table thead th {
            padding: 14px 12px;
        }

        .product-info {
            align-items: start;
        }

        .text-desc {
            max-width: 180px;
        }
    }
</style>

<nav class="admin-navbar">
    <div class="inner">
        <a href="{{ route('admin.dashboard') }}" class="brand">UNDONET</span></a>

        <div class="nav-pills">
            <a href="{{ route('admin.dashboard') }}" class="nav-pill active"><i class="bi bi-grid-1x2"></i> Dashboard</a>
            <a href="{{ route('admin.transaksi') }}" class="nav-pill"><i class="bi bi-cart-check"></i> Transaksi</a>
            <a href="{{ route('admin.finances') }}" class="nav-pill"><i class="bi bi-bar-chart-line"></i> Keuangan</a>
            <a href="{{ route('admin.pelanggan') }}" class="nav-pill"><i class="bi bi-people"></i> Pelanggan</a>
        </div>

        <button type="button" class="logout-btn" onclick="confirmLogout()" title="Logout">
            <i class="bi bi-power"></i>
        </button>
    </div>
</nav>

<div class="page-shell">
    <div class="hero-card">
        <span class="hero-kicker"><i class="bi bi-broadcast-pin"></i> Admin Panel UNDONET</span>
        <h1 class="hero-title">Kelola produk dengan tampilan yang bersih, cepat, dan rapi.</h1>
        <p class="hero-sub">
            Dashboard ini membantu Anda mengatur katalog produk, memantau stok, dan menjaga tampilan admin tetap konsisten dengan identitas visual UNDONET.
        </p>
        <div class="hero-badges">
            <div class="hero-chip"><i class="bi bi-box-seam"></i> {{ $produk->count() }} produk aktif</div>
            <div class="hero-chip"><i class="bi bi-bookmark-star"></i> {{ $kategoris->count() }} kategori tersedia</div>
            <div class="hero-chip"><i class="bi bi-database-check"></i> {{ $produk->sum('stok') }} stok total</div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-soft mb-4">
            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle me-2"></i>Gagal menyimpan data</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
                <div>
                    <div class="stat-label">Total Produk</div>
                    <div class="stat-value">{{ $produk->count() }}</div>
                    <div class="stat-sub">Item di katalog</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-bookmark-star"></i></div>
                <div>
                    <div class="stat-label">Kategori Aktif</div>
                    <div class="stat-value">{{ $kategoris->count() }}</div>
                    <div class="stat-sub">Jenis kategori</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-database-check"></i></div>
                <div>
                    <div class="stat-label">Total Stok</div>
                    <div class="stat-value">{{ $produk->sum('stok') }}</div>
                    <div class="stat-sub">Unit tersedia</div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-card">
        <div class="card-head">
            <div>
                <span class="section-kicker">Tambah Produk</span>
                <h5 class="section-title">Inventori baru</h5>
                <p class="section-sub">Masukkan data produk baru ke katalog UNDONET.</p>
            </div>
        </div>
        <div class="p-4 p-lg-4">
            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Contoh: Paket Fiber 100 Mbps" required>
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Harga (IDR)</label>
                        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" placeholder="0" min="0" required>
                        @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" placeholder="0" min="0" required>
                        @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                            <option value="">Pilih...</option>
                            @foreach(['Gaming','Ultrabook','Business','Student','Second'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="poto" class="form-control @error('poto') is-invalid @enderror" accept="image/*">
                        @error('poto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Spesifikasi dan detail produk...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn-undonet-primary">
                            <i class="bi bi-floppy"></i>
                            Simpan ke Katalog
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-card">
        <div class="card-head">
            <div>
                <span class="section-kicker">Daftar Produk</span>
                <h5 class="section-title">Inventori aktif</h5>
                <p class="section-sub">Kelola produk yang tampil di halaman pelanggan.</p>
            </div>
            <span class="badge-soft"><i class="bi bi-layers"></i> {{ $produk->count() }} item</span>
        </div>

        <div class="table-responsive">
            <table class="table product-table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4" width="60">No</th>
                        <th>Info Produk</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status Stok</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $i => $p)
                    <tr>
                        <td class="ps-4 text-muted small">{{ $i + 1 }}</td>
                        <td>
                            <div class="product-info">
                                @if($p->poto)
                                    <img src="{{ asset('storage/'.$p->poto) }}" class="product-thumb" alt="{{ $p->nama }}">
                                @else
                                    <div class="thumb-placeholder">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="product-name">{{ $p->nama }}</div>
                                    <div class="product-id">ID: FZ-{{ 100 + $p->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td><div class="text-desc">{{ $p->deskripsi ?? 'Belum ada deskripsi.' }}</div></td>
                        <td><span class="badge-kat">{{ $p->kategori }}</span></td>
                        <td class="price">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td>
                            @if($p->stok > 0)
                                <span class="badge-in"><i class="bi bi-check-circle"></i> Tersedia ({{ $p->stok }})</span>
                            @else
                                <span class="badge-out"><i class="bi bi-x-circle"></i> Habis</span>
                            @endif
                        </td>
                        <td class="text-center pe-4">
                            <div class="d-flex gap-2 justify-content-center">
                                <button class="btn-icon" data-bs-toggle="modal" data-bs-target="#editModal{{ $p->id }}" title="Ubah">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('admin.produk.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event, '{{ $p->nama }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-icon-danger" title="Hapus">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-secondary d-block mb-3"></i>
                            <p class="text-muted fw-bold mb-0">Belum ada produk di database.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($produk as $p)
    <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Produk — {{ $p->nama }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.produk.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', $p->nama) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Harga (IDR)</label>
                                <input type="number" name="harga" class="form-control" value="{{ old('harga', $p->harga) }}" min="0" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" value="{{ old('stok', $p->stok) }}" min="0" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select name="kategori" class="form-select" required>
                                    @foreach(['Gaming','Ultrabook','Business','Student','Second'] as $kat)
                                        <option value="{{ $kat }}" {{ old('kategori', $p->kategori) === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ganti Gambar</label>
                                <input type="file" name="poto" class="form-control" accept="image/*">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $p->deskripsi) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-undonet-outline" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-undonet-primary">
                            <i class="bi bi-floppy"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmDelete(e, nama) {
        e.preventDefault();
        const form = e.target;
        Swal.fire({
            title: 'Hapus Produk?',
            text: `"${nama}" akan dihapus secara permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            customClass: { popup: 'swal2-popup' }
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
        return false;
    }

    function confirmLogout() {
        Swal.fire({
            title: 'Keluar Sesi?',
            text: 'Anda akan keluar dari panel administrasi.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            confirmButtonText: 'Keluar',
            cancelButtonText: 'Batal',
            customClass: { popup: 'swal2-popup' }
        }).then((result) => {
            if (result.isConfirmed) document.getElementById('logout-form').submit();
        });
    }
</script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: 'Berhasil!',
            text: @json(session('success')),
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#dc2626',
            customClass: { popup: 'swal2-popup' }
        });
    });
</script>
@endif
@endsection
