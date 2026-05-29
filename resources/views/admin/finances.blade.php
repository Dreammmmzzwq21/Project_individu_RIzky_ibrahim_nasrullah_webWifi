@extends('layouts.app')

@section('title', 'Kelola Keuangan — UNDONET')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    header, nav.navbar, footer, .main-header, .main-footer, aside.main-sidebar {
        display: none !important;
    }
    #app, main, .py-4, .content-wrapper { padding: 0 !important; margin: 0 !important; background: none !important; }

    :root {
        --primary-blue: #2563eb;
        --success-green: #22c55e;
        --danger-red: #ef4444;
        --dark-slate: #0f172a;
        --light-bg: #f8fafc;
        --border-color: #e2e8f0;
    }

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
        z-index: 2000; box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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
    .main-container { max-width: 1400px; margin: 0 auto; padding: 30px 40px; }
    .page-title { font-size: 26px; font-weight: 800; margin-bottom: 4px; }

    .stat-card {
        background: white; border-radius: 20px; padding: 22px;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        transition: 0.2s;
    }
    .stat-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.08); transform: translateY(-1px); }
    .stat-icon {
        width: 48px; height: 48px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center; font-size: 22px;
    }
    .stat-label { font-size: 12px; color: #64748b; font-weight: 600; margin-bottom: 4px; }
    .stat-value { font-family: 'JetBrains Mono', monospace; font-size: 20px; font-weight: 700; }

    .finance-card {
        background: white; border-radius: 24px; border: 1px solid var(--border-color);
        padding: 25px; margin-bottom: 25px;
    }

    .data-table-card {
        background: white; border-radius: 20px; border: 1px solid var(--border-color);
        overflow: hidden;
    }
    .table-header {
        padding: 18px 25px; border-bottom: 1px solid #f1f5f9;
        display: flex; justify-content: space-between; align-items: center;
    }
    .table thead th {
        background: #f8fafc; color: #64748b; font-size: 11px;
        font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        padding: 12px 20px; border: none;
    }
    .table tbody td {
        padding: 16px 20px; border-bottom: 1px solid #f1f5f9;
        font-size: 13.5px; vertical-align: middle;
    }
    .table tbody tr:last-child td { border-bottom: none; }
    .table tfoot td { padding: 14px 20px; background: #f8fafc; }

    .text-money { font-family: 'JetBrains Mono', monospace; font-weight: 700; }
    .empty-state { padding: 50px; text-align: center; color: #94a3b8; }

    .rank-badge {
        width: 26px; height: 26px; border-radius: 8px;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 800;
    }
    .rank-1 { background: #fef3c7; color: #d97706; }
    .rank-2 { background: #f1f5f9; color: #475569; }
    .rank-3 { background: #fef2f2; color: #b45309; }
    .rank-other { background: #f8fafc; color: #94a3b8; }
</style>

{{-- NAVBAR --}}
<nav class="top-navbar">
    <a href="{{ route('admin.dashboard') }}" class="nav-brand">UNDO<span>NET</span></a>
    <div class="nav-menu-wrapper">
        <a href="{{ route('admin.dashboard') }}" class="nav-item-link">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <a href="{{ route('admin.transaksi') }}" class="nav-item-link">
            <i class="bi bi-cart-check"></i> Transaksi
        </a>
        <a href="{{ route('admin.finances') }}" class="nav-item-link active">
            <i class="bi bi-bar-chart-line"></i> Keuangan
        </a>
        <a href="{{ route('admin.pelanggan') }}" class="nav-item-link">
            <i class="bi bi-people"></i> Pelanggan
        </a>
        
    </div>
    <div class="d-flex align-items-center gap-3">
        <button type="button" class="btn-logout-nav" onclick="confirmLogout()" title="Keluar Sesi">
            <i class="bi bi-power fs-5"></i>
        </button>
    </div>
</nav>

<div class="main-container">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="page-title">Laporan Keuangan</h1>
            <p class="text-muted mb-0">Ringkasan pendapatan & penjualan produk</p>
        </div>
        <small class="text-muted fw-600">{{ now()->translatedFormat('F Y') }}</small>
    </div>

    {{-- STAT CARDS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary text-white"><i class="bi bi-wallet2"></i></div>
                    <div>
                        <div class="stat-label">Total Pendapatan</div>
                        <div class="stat-value text-primary">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success text-white"><i class="bi bi-receipt"></i></div>
                    <div>
                        <div class="stat-label">Total Transaksi</div>
                        <div class="stat-value text-success">{{ number_format($totalTransaksi, 0, ',', '.') }} transaksi</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-warning text-white"><i class="bi bi-box-seam"></i></div>
                    <div>
                        <div class="stat-label">Total Produk Terjual</div>
                        <div class="stat-value text-warning">{{ number_format($totalProdukTerjual, 0, ',', '.') }} unit</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- GRAFIK --}}
    <div class="finance-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-800 mb-0">Grafik Pendapatan</h5>
            <div class="d-flex gap-2">
                <button onclick="gantiGrafik('minggu')" id="btn-minggu"
                    class="btn btn-sm btn-primary rounded-3">Per Minggu</button>
                <button onclick="gantiGrafik('bulan')" id="btn-bulan"
                    class="btn btn-sm btn-outline-secondary rounded-3">6 Bulan</button>
            </div>
        </div>
        <div style="height: 300px;">
            <canvas id="financeChart"></canvas>
        </div>
    </div>

    {{-- TABEL RINCIAN --}}
    <div class="data-table-card">
        <div class="table-header">
            <h6 class="fw-800 mb-0">Rincian Penjualan per Produk</h6>
            <span class="badge bg-light text-dark border">{{ $rincianPenjualan->count() }} produk</span>
        </div>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Satuan</th>
                        <th>Qty Terjual</th>
                        <th class="text-end">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rincianPenjualan as $i => $item)
                    <tr>
                        <td>
                            <span class="rank-badge {{ $i === 0 ? 'rank-1' : ($i === 1 ? 'rank-2' : ($i === 2 ? 'rank-3' : 'rank-other')) }}">
                                {{ $i + 1 }}
                            </span>
                        </td>
                        <td class="fw-600">{{ $item->nama }}</td>
                        <td>
                            <span class="badge bg-light text-dark border rounded-3">
                                {{ $item->kategori ?? '-' }}
                            </span>
                        </td>
                        <td class="text-money text-muted">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td><span class="fw-700">{{ $item->qty_terjual }}</span> unit</td>
                        <td class="text-end">
                            <span class="text-money text-success fw-800">
                                Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada data penjualan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($rincianPenjualan->count() > 0)
                <tfoot>
                    <tr>
                        <td colspan="5" class="fw-800">TOTAL PENDAPATAN</td>
                        <td class="text-end">
                            <span class="text-money fw-800 text-primary">
                                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </span>
                        </td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>

</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>

<script>
    // ── DATA DARI PHP ────────────────────────────────────────────────────
    const grafikMinggu = @json($grafikData);
    const grafikBulan  = @json($grafikBulanan);

    const namaBulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

    // Susun label & value untuk grafik mingguan
    const labelMinggu = grafikMinggu.length
        ? grafikMinggu.map((d, i) => `Minggu ${i + 1}`)
        : ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
    const valueMinggu = grafikMinggu.length
        ? grafikMinggu.map(d => d.total)
        : [0, 0, 0, 0];

    // Susun label & value untuk grafik bulanan
    const labelBulan = grafikBulan.map(d => namaBulan[d.bulan - 1]);
    const valueBulan = grafikBulan.map(d => d.total);

    // ── INISIALISASI CHART ───────────────────────────────────────────────
    const ctx = document.getElementById('financeChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelMinggu,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: valueMinggu,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.08)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#2563eb',
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) => ' Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: (val) => 'Rp ' + (val / 1000000).toFixed(0) + 'jt'
                    }
                }
            }
        }
    });

    // ── TOGGLE GRAFIK ────────────────────────────────────────────────────
    function gantiGrafik(mode) {
        if (mode === 'minggu') {
            chart.data.labels   = labelMinggu;
            chart.data.datasets[0].data = valueMinggu;
            document.getElementById('btn-minggu').className = 'btn btn-sm btn-primary rounded-3';
            document.getElementById('btn-bulan').className  = 'btn btn-sm btn-outline-secondary rounded-3';
        } else {
            chart.data.labels   = labelBulan;
            chart.data.datasets[0].data = valueBulan;
            document.getElementById('btn-bulan').className  = 'btn btn-sm btn-primary rounded-3';
            document.getElementById('btn-minggu').className = 'btn btn-sm btn-outline-secondary rounded-3';
        }
        chart.update();
    }

    // ── LOGOUT ───────────────────────────────────────────────────────────
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
@endsection