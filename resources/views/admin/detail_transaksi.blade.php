<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi #{{ $transaksi->id }} — UNDONET</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-blue: #2563eb;
            --dark-slate: #0f172a;
            --light-bg: #f8fafc;
            --border-color: #e2e8f0;
            --danger-red: #ef4444;
            --success-green: #22c55e;
        }

        * { box-sizing: border-box; }

        body {
            background: var(--light-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--dark-slate);
            margin: 0;
            padding-top: 75px;
        }

        /* ── NAVBAR ── */
        .top-navbar {
            position: fixed; top: 0; left: 0; right: 0;
            height: 75px; background: var(--dark-slate);
            display: flex; align-items: center; padding: 0 40px;
            z-index: 2000; box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .nav-brand {
            font-size: 24px; font-weight: 800; color: #fff;
            text-decoration: none; margin-right: 50px; letter-spacing: -1px;
        }
        .nav-brand span { color: var(--primary-blue); }
        .nav-menu-wrapper { display: flex; align-items: center; gap: 5px; flex: 1; }
        .nav-item-link {
            display: flex; align-items: center; gap: 10px; padding: 10px 18px;
            color: rgba(255,255,255,0.5); text-decoration: none;
            font-size: 14px; font-weight: 600; border-radius: 12px; transition: 0.3s;
        }
        .nav-item-link:hover { color: #fff; background: rgba(255,255,255,0.05); }
        .nav-item-link.active { background: var(--primary-blue); color: white; }
        .btn-logout-nav {
            background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.6); border-radius: 10px; padding: 8px 12px;
            cursor: pointer; transition: 0.2s;
        }
        .btn-logout-nav:hover { background: var(--danger-red); color: white; border-color: var(--danger-red); }

        /* ── LAYOUT ── */
        .main-container { max-width: 1000px; margin: 0 auto; padding: 30px 40px; }

        /* ── BREADCRUMB ── */
        .back-btn {
            display: inline-flex; align-items: center; gap: 8px;
            color: #64748b; text-decoration: none; font-size: 13px; font-weight: 600;
            padding: 8px 16px; border-radius: 10px; border: 1px solid var(--border-color);
            background: white; transition: 0.2s;
        }
        .back-btn:hover { background: var(--dark-slate); color: white; border-color: var(--dark-slate); }

        /* ── HEADER CARD ── */
        .header-card {
            background: var(--dark-slate);
            border-radius: 24px;
            padding: 30px 35px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }
        .header-card::before {
            content: '#{{ $transaksi->id }}';
            position: absolute; right: 30px; top: 50%; transform: translateY(-50%);
            font-family: 'JetBrains Mono', monospace;
            font-size: 80px; font-weight: 700;
            color: rgba(255,255,255,0.04);
            letter-spacing: -4px;
        }
        .trx-id {
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px; color: rgba(255,255,255,0.4);
            margin-bottom: 6px; letter-spacing: 1px; text-transform: uppercase;
        }
        .trx-title {
            font-size: 28px; font-weight: 800; color: white; margin-bottom: 16px;
        }
        .trx-meta {
            display: flex; gap: 20px; flex-wrap: wrap;
        }
        .meta-chip {
            display: flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px; padding: 8px 16px;
            color: rgba(255,255,255,0.7); font-size: 13px; font-weight: 500;
        }
        .meta-chip i { color: rgba(255,255,255,0.4); }

        /* ── INFO GRID ── */
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; }

        .info-card {
            background: white; border-radius: 20px; padding: 24px;
            border: 1px solid var(--border-color);
        }
        .info-card-title {
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.8px; color: #94a3b8; margin-bottom: 16px;
            display: flex; align-items: center; gap: 8px;
        }
        .info-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 10px 0; border-bottom: 1px solid #f1f5f9;
        }
        .info-row:last-child { border-bottom: none; padding-bottom: 0; }
        .info-label { font-size: 13px; color: #64748b; font-weight: 500; }
        .info-value { font-size: 13.5px; font-weight: 700; text-align: right; }

        /* ── TABEL ITEM ── */
        .items-card {
            background: white; border-radius: 20px;
            border: 1px solid var(--border-color); overflow: hidden;
            margin-bottom: 24px;
        }
        .items-header {
            padding: 20px 25px; border-bottom: 1px solid #f1f5f9;
            display: flex; justify-content: space-between; align-items: center;
        }
        .table { margin: 0; }
        .table thead th {
            background: #f8fafc; color: #64748b; font-size: 11px;
            font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
            padding: 12px 20px; border: none;
        }
        .table tbody td {
            padding: 18px 20px; border-bottom: 1px solid #f1f5f9;
            font-size: 13.5px; vertical-align: middle;
        }
        .table tbody tr:last-child td { border-bottom: none; }

        .produk-img {
            width: 48px; height: 48px; border-radius: 12px;
            object-fit: cover; border: 1px solid var(--border-color);
            background: #f8fafc;
        }
        .produk-img-placeholder {
            width: 48px; height: 48px; border-radius: 12px;
            background: #f1f5f9; display: flex; align-items: center;
            justify-content: center; color: #94a3b8; font-size: 18px;
        }

        .text-money { font-family: 'JetBrains Mono', monospace; font-weight: 700; }

        /* ── TOTAL FOOTER ── */
        .total-section {
            background: white; border-radius: 20px; padding: 24px 30px;
            border: 1px solid var(--border-color);
            display: flex; justify-content: space-between; align-items: center;
        }
        .total-label { font-size: 14px; color: #64748b; font-weight: 600; }
        .total-value {
            font-family: 'JetBrains Mono', monospace;
            font-size: 28px; font-weight: 800; color: var(--primary-blue);
        }

        /* ── ACTION BUTTONS ── */
        .action-bar {
            display: flex; gap: 12px; margin-top: 24px;
        }
        .btn-invoice {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--primary-blue); color: white;
            border: none; border-radius: 12px; padding: 12px 24px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px; font-weight: 700; cursor: pointer; transition: 0.2s;
            text-decoration: none;
        }
        .btn-invoice:hover { background: #1d4ed8; color: white; transform: translateY(-1px); }
        .btn-back-action {
            display: inline-flex; align-items: center; gap: 8px;
            background: white; color: var(--dark-slate);
            border: 1px solid var(--border-color); border-radius: 12px; padding: 12px 24px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px; font-weight: 700; cursor: pointer; transition: 0.2s;
            text-decoration: none;
        }
        .btn-back-action:hover { background: var(--dark-slate); color: white; border-color: var(--dark-slate); }

        @media (max-width: 768px) {
            .main-container { padding: 20px; }
            .info-grid { grid-template-columns: 1fr; }
            .top-navbar { padding: 0 20px; }
            .header-card { padding: 24px; }
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="top-navbar">
    <a href="{{ route('admin.dashboard') }}" class="nav-brand">FAIZI<span>FY</span></a>
    <div class="nav-menu-wrapper">
        <a href="{{ route('admin.dashboard') }}" class="nav-item-link">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <a href="{{ route('admin.transaksi') }}" class="nav-item-link active">
            <i class="bi bi-cart-check"></i> Transaksi
        </a>
        <a href="{{ route('admin.finances') }}" class="nav-item-link">
            <i class="bi bi-bar-chart-line"></i> Keuangan
        </a>
        <a href="{{ route('admin.pelanggan') }}" class="nav-item-link">
            <i class="bi bi-people"></i> Pelanggan
        </a>
        <a href="{{ route('admin.pesan') }}" class="nav-item-link">
            <i class="bi bi-chat-left-text"></i> Pesan
            @php $unread = \App\Models\Pesan::whereNull('balasan')->count(); @endphp
            @if($unread > 0)
                <span class="ms-2 badge bg-danger rounded-pill" style="font-size:10px;">{{ $unread }}</span>
            @endif
        </a>
    </div>
    <div class="d-flex align-items-center gap-3">
        <button type="button" class="btn-logout-nav" onclick="confirmLogout()" title="Keluar Sesi">
            <i class="bi bi-power fs-5"></i>
        </button>
    </div>
</nav>

<div class="main-container">

    {{-- BACK --}}
    <div class="mb-4">
        <a href="{{ route('admin.transaksi') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i> Kembali ke Transaksi
        </a>
    </div>

    {{-- HEADER CARD --}}
    <div class="header-card">
        <div class="trx-id">Transaksi ID</div>
        <div class="trx-title">#{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</div>
        <div class="trx-meta">
            <div class="meta-chip">
                <i class="bi bi-calendar3"></i>
                {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}
            </div>
            <div class="meta-chip">
                <i class="bi bi-truck"></i>
                {{ $transaksi->pengiriman ?? '-' }}
            </div>
            <div class="meta-chip">
                <i class="bi bi-credit-card"></i>
                {{ $transaksi->pembayaran ?? '-' }}
            </div>
            <div class="meta-chip" style="background: rgba(34,197,94,0.15); border-color: rgba(34,197,94,0.2);">
                <i class="bi bi-check-circle-fill" style="color: #22c55e;"></i>
                <span style="color: #22c55e; font-weight: 700;">Selesai</span>
            </div>
        </div>
    </div>

    {{-- INFO GRID --}}
    <div class="info-grid">
        {{-- Info Pelanggan --}}
        <div class="info-card">
            <div class="info-card-title">
                <i class="bi bi-person-circle"></i> Info Pelanggan
            </div>
            <div class="info-row">
                <span class="info-label">Nama</span>
                <span class="info-value">{{ $transaksi->pelanggan->nama }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value" style="font-size:12px;">{{ $transaksi->pelanggan->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">No. HP</span>
                <span class="info-value">{{ $transaksi->pelanggan->hp ?? '-' }}</span>
            </div>
        </div>

        {{-- Info Pembayaran --}}
        <div class="info-card">
            <div class="info-card-title">
                <i class="bi bi-receipt"></i> Info Pembayaran
            </div>
            <div class="info-row">
                <span class="info-label">Metode</span>
                <span class="info-value">{{ $transaksi->pembayaran ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Pengiriman</span>
                <span class="info-value">{{ $transaksi->pengiriman ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Order</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</span>
            </div>
        </div>
    </div>

    {{-- TABEL ITEM --}}
    <div class="items-card">
        <div class="items-header">
            <h6 class="fw-800 mb-0">Item yang Dibeli</h6>
            <span class="badge bg-light text-dark border">
                {{ $transaksi->details->count() }} item
            </span>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi->details as $i => $d)
                    <tr>
                        <td class="text-muted fw-600">{{ $i + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($d->produk->poto)
                                    <img src="{{ asset('storage/' . $d->produk->poto) }}"
                                         class="produk-img" alt="{{ $d->produk->nama }}">
                                @else
                                    <div class="produk-img-placeholder">
                                        <i class="bi bi-laptop"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-700" style="font-size:13.5px;">{{ $d->produk->nama }}</div>
                                    <small class="text-muted">{{ $d->produk->kategori ?? '' }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-money text-muted">
                            Rp {{ number_format($d->produk->harga, 0, ',', '.') }}
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border fw-700">
                                {{ $d->jumlah }} unit
                            </span>
                        </td>
                        <td class="text-end text-money fw-800">
                            Rp {{ number_format($d->produk->harga * $d->jumlah, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- TOTAL & ACTIONS --}}
    <div class="total-section">
        <div>
            <div class="total-label">Total Pembayaran</div>
            <div class="total-value">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</div>
        </div>
        <div class="action-bar" style="margin-top:0;">
            <a href="{{ route('admin.transaksi') }}" class="btn-back-action">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('admin.invoice', $transaksi->id) }}" class="btn-invoice" target="_blank">
                <i class="bi bi-printer"></i> Cetak Invoice
            </a>
        </div>
    </div>

</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: "Keluar Sesi?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#ef4444",
            cancelButtonText: "Batal",
            confirmButtonText: "Ya, Keluar"
        }).then((res) => {
            if (res.isConfirmed) document.getElementById('logout-form').submit();
        });
    }
</script>
</body>
</html>