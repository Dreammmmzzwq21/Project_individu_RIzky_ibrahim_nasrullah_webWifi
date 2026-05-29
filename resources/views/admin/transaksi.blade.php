@extends('layouts.app')

@section('title', 'Riwayat Transaksi — UNDONET')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Reset & Clean Layout */
    header, nav.navbar, footer, .main-header, .main-footer, aside.main-sidebar {
        display: none !important;
    }
    #app, main, .py-4, .content-wrapper { padding: 0 !important; margin: 0 !important; background: none !important; }

    :root {
        --primary-blue: #2563eb;
        --dark-slate:   #0f172a;
        --light-bg:     #f8fafc;
        --border-color: #e2e8f0;
        --danger-red:   #ef4444;
        --success-green:#22c55e;
        --text-muted:   #64748b;
        --mono: 'JetBrains Mono', monospace;
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
    .main-container { max-width: 1200px; margin: 0 auto; padding: 36px 40px 60px; }

    /* ── PAGE TITLE ── */
    .page-title { font-size: 20px; font-weight: 800; color: var(--dark-slate); margin-bottom: 4px; }
    .page-sub { font-size: 13px; color: var(--text-muted); margin-bottom: 24px; }

    /* ── TABLE CARD ── */
    .table-card {
        background: white; border-radius: 20px;
        border: 1px solid var(--border-color); overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    .table-card-header {
        padding: 18px 22px; border-bottom: 1px solid #f1f5f9;
        display: flex; justify-content: space-between; align-items: center;
    }
    .table-card-title { font-size: 13px; font-weight: 800; color: var(--dark-slate); }

    .header-actions { display: flex; gap: 10px; }

    .btn-outline-action {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 16px; border-radius: 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 12px; font-weight: 700;
        border: 1px solid var(--border-color);
        background: white; color: var(--text-muted);
        cursor: pointer; transition: .15s; text-decoration: none;
    }
    .btn-outline-action:hover { background: #f1f5f9; color: var(--dark-slate); }

    .btn-solid-action {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 16px; border-radius: 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 12px; font-weight: 700;
        border: none; background: var(--primary-blue); color: white;
        cursor: pointer; transition: .15s; text-decoration: none;
    }
    .btn-solid-action:hover { background: #1d4ed8; color: white; }

    /* ── TABLE ── */
    table { width: 100%; border-collapse: collapse; }

    thead th {
        background: #f8fafc;
        font-size: 10px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .06em;
        color: #94a3b8;
        padding: 11px 18px; text-align: left;
        border-bottom: 1px solid var(--border-color);
    }
    thead th.th-center { text-align: center; }

    tbody td {
        padding: 14px 18px; font-size: 13px;
        border-bottom: 1px solid #f8fafc;
        vertical-align: middle;
    }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover { background: #fafbfc; }

    .td-num { font-size: 11px; color: #94a3b8; font-weight: 700; width: 32px; }

    /* Invoice badge */
    .inv-badge {
        display: inline-block;
        background: #eff6ff; color: var(--primary-blue);
        border: 1px solid #bfdbfe;
        font-family: var(--mono); font-size: 11px; font-weight: 700;
        padding: 4px 10px; border-radius: 8px;
    }

    /* Customer cell */
    .customer-cell { display: flex; align-items: center; gap: 11px; }
    .customer-icon {
        width: 36px; height: 36px; border-radius: 10px;
        background: #eff6ff; border: 1px solid #bfdbfe;
        display: flex; align-items: center; justify-content: center;
        color: var(--primary-blue); font-size: 15px; flex-shrink: 0;
    }
    .customer-name { font-size: 13px; font-weight: 700; color: var(--dark-slate); }
    .customer-email { font-size: 11px; color: #94a3b8; margin-top: 1px; }

    /* Date cell */
    .date-main { font-size: 13px; font-weight: 600; color: var(--dark-slate); }
    .date-time { font-family: var(--mono); font-size: 11px; color: #94a3b8; margin-top: 2px; }

    /* Total cell */
    .text-money { font-family: var(--mono); font-weight: 700; color: var(--dark-slate); }
    .lunas-badge {
        display: inline-flex; align-items: center; gap: 4px;
        background: #f0fdf4; color: #16a34a;
        border: 1px solid #bbf7d0;
        font-size: 9px; font-weight: 700;
        padding: 2px 8px; border-radius: 6px;
        text-transform: uppercase; letter-spacing: .06em;
        margin-top: 4px;
    }

    /* Action buttons */
    .btn-act {
        width: 32px; height: 32px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 8px; transition: .15s;
        border: 1px solid var(--border-color);
        color: #64748b; background: white;
        text-decoration: none; cursor: pointer; font-size: 13px;
    }
    .btn-act:hover { background: #f1f5f9; color: var(--primary-blue); border-color: #bfdbfe; }
    .btn-act.btn-act-danger:hover { background: #fef2f2; color: var(--danger-red); border-color: #fecaca; }

    /* Footer */
    .table-footer {
        padding: 12px 22px; background: #f8fafc;
        border-top: 1px solid var(--border-color);
        font-size: 12px; color: var(--text-muted); font-weight: 600;
        text-align: center;
    }

    /* Empty state */
    .empty-state { padding: 64px 32px; text-align: center; }
    .empty-icon {
        width: 72px; height: 72px; background: #f1f5f9; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 28px; color: #94a3b8; margin: 0 auto 14px;
    }
    .empty-text { font-size: 14px; font-weight: 700; color: var(--dark-slate); margin-bottom: 4px; }
    .empty-sub { font-size: 12px; color: var(--text-muted); }

    /* SweetAlert custom */
    .swal-popup {
        border-radius: 20px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        padding: 28px !important;
        border: 1px solid #e2e8f0 !important;
    }
    .swal2-title { font-size: 17px !important; font-weight: 800 !important; color: var(--dark-slate) !important; }
    .swal2-html-container { font-size: 13px !important; color: var(--text-muted) !important; }
    .swal2-confirm, .swal2-cancel {
        border-radius: 10px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-size: 13px !important; font-weight: 700 !important;
        padding: 10px 22px !important; border: none !important;
    }
    .swal2-cancel { background: #f1f5f9 !important; color: #475569 !important; }
    .swal2-actions { gap: 10px !important; margin-top: 18px !important; }
</style>

{{-- NAVBAR --}}
<nav class="top-navbar">
    <a href="{{ route('admin.dashboard') }}" class="nav-brand">UNDO<span>NET</span></a>
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
    </div>
    
        <button type="button" class="btn-logout-nav" onclick="confirmLogout()" title="Keluar">
            <i class="bi bi-power fs-5"></i>
        </button>
    </div>
</nav>

<div class="main-container">

    {{-- PAGE TITLE --}}
    <div class="page-title">Riwayat Transaksi</div>
    <div class="page-sub">Pantau dan kelola semua transaksi penjualan secara teliti &amp; rapi.</div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-3 mb-4" style="font-size:13px; background:#f0fdf4; color:#16a34a; padding: 15px;">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="table-card">

        {{-- TABLE HEADER --}}
        <div class="table-card-header">
            <span class="table-card-title"><i class="bi bi-list-stars me-2"></i>Transaksi Terbaru</span>
            <div class="header-actions">
                <button class="btn-outline-action" onclick="window.print()">
                    <i class="bi bi-printer"></i> Cetak Laporan
                </button>
                <a href="#" class="btn-solid-action">
                    <i class="bi bi-download"></i> Ekspor Excel
                </a>
            </div>
        </div>

        {{-- TABLE CONTENT --}}
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width:32px;">#</th>
                        <th>ID Invoice</th>
                        <th>Pelanggan</th>
                        <th>Tanggal &amp; Waktu</th>
                        <th>Total</th>
                        <th class="th-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $i => $t)
                    <tr>
                        <td class="td-num">{{ $i + 1 }}</td>
                        <td>
                            <span class="inv-badge">#INV-{{ str_pad($t->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td>
                            <div class="customer-cell">
                                <div class="customer-icon"><i class="bi bi-person"></i></div>
                                <div>
                                    <div class="customer-name">{{ $t->pelanggan->nama }}</div>
                                    <div class="customer-email">{{ $t->pelanggan->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="date-main">
                                {{ \Carbon\Carbon::parse($t->tanggal)->timezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                            </div>
                            <div class="date-time">
                                {{ \Carbon\Carbon::parse($t->created_at)->timezone('Asia/Jakarta')->format('H:i') }} WIB
                            </div>
                        </td>
                        <td>
                            <div class="text-money">Rp {{ number_format($t->total_harga,0,',','.') }}</div>
                            <div class="lunas-badge"><i class="bi bi-check2-circle"></i> Lunas</div>
                        </td>
                        <td>
                            <div style="display:flex;justify-content:center;gap:6px;">
                                <a href="{{ route('admin.transaksi.detail', $t->id) }}" class="btn-act" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.invoice', $t->id) }}" class="btn-act" target="_blank" title="Cetak Invoice">
                                    <i class="bi bi-file-earmark-text"></i>
                                </a>
                                <form class="form-hapus-trx d-inline" action="{{ route('admin.transaksi.destroy', $t->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-act btn-act-danger btn-hapus-trx" data-id="{{ $t->id }}" title="Hapus">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="bi bi-inbox"></i></div>
                                <div class="empty-text">Belum ada transaksi</div>
                                <div class="empty-sub">Data transaksi akan muncul di sini setelah ada pembelian baru.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            Total: <strong>{{ $transaksi->count() }}</strong> data transaksi ditemukan
        </div>
    </div>

</div>

{{-- Hidden Logout Form --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* ── Logout Logic ── */    
    function confirmLogout() {
        Swal.fire({
            title: 'Keluar dari Sesi?',
            text: "Anda harus login kembali untuk mengakses panel admin.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: { 
                popup: 'swal-popup',
                cancelButton: 'swal2-cancel'
            },
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    /* ── Delete Transaction Logic ── */
    document.querySelectorAll('.btn-hapus-trx').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const form = this.closest('form');
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Transaksi?',
                html: `<span style="font-size:13px;color:#64748b;">Transaksi <strong style="color:#0f172a;">#INV-${String(id).padStart(5,'0')}</strong> akan dihapus permanen.</span>`,
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#ef4444',
                reverseButtons: true,
                customClass: { popup: 'swal-popup' },
            }).then(r => { if (r.isConfirmed) form.submit(); });
        });
    });
</script>
@endsection