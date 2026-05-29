@extends('layouts.app')

@section('title', 'Daftar Pelanggan — Admin UNDONET')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* 1. RESET LAYOUT (Hapus Sidebar/Navbar Bawaan) */
    header, nav.navbar, footer, .main-header, .main-footer, aside.main-sidebar { 
        display: none !important; 
        visibility: hidden !important;
    }
    #app, main, .py-4, .content-wrapper { padding: 0 !important; margin: 0 !important; background: none !important; }

    :root {
        --primary-blue: #2563eb;
        --dark-slate: #0f172a;
        --light-bg: #f8fafc;
        --border-color: #e2e8f0;
    }

    body { 
        background: var(--light-bg); 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        color: var(--dark-slate);
        margin: 0;
        padding-top: 75px; /* Ruang untuk navbar atas */
    }

    /* 2. NAVBAR HORIZONTAL (SAMA DENGAN PESAN MASUK) */
    .top-navbar {
        position: fixed;
        top: 0; left: 0; right: 0;
        height: 75px;
        background: var(--dark-slate);
        display: flex;
        align-items: center;
        padding: 0 40px;
        z-index: 2000;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .nav-brand {
        font-size: 24px; font-weight: 800; color: #fff; text-decoration: none;
        margin-right: 50px; letter-spacing: -1px;
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

    .badge-notif {
        background: #ef4444; color: white; font-size: 10px;
        padding: 2px 7px; border-radius: 50px; font-weight: 800; margin-left: 5px;
    }

    .btn-logout-nav {
    background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.6); border-radius: 10px; padding: 8px 12px;
    cursor: pointer; transition: 0.2s;
     }
      .btn-logout-nav:hover { background: #ef4444; color: white; border-color: #ef4444; }

    /* 3. TABLE AREA */
    .main-container { max-width: 1200px; margin: 0 auto; padding: 40px; }
    
    .header-section { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 35px; }
    .page-title { font-size: 32px; font-weight: 800; letter-spacing: -1px; margin: 0; }

    .table-card {
        background: white; border-radius: 20px; border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); overflow: hidden;
    }

    .table thead th {
        background: #f1f5f9; color: #64748b; font-size: 12px;
        font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        padding: 20px; border: none;
    }

    .table tbody td { padding: 20px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }

    .avatar-ui {
        width: 42px; height: 42px; background: #eff6ff; color: var(--primary-blue);
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px; font-weight: 800; font-size: 14px;
    }

    .badge-user { background: #f1f5f9; color: #475569; font-size: 12px; padding: 4px 10px; border-radius: 6px; font-weight: 600; }

    .btn-reset {
        background: transparent; color: #f59e0b; border: 1.5px solid #f59e0b;
        border-radius: 10px; padding: 8px 16px; font-size: 13px; font-weight: 700; transition: 0.2s; cursor: pointer;
    }
    .btn-reset:hover { background: #fffbeb; }

</style>

<nav class="top-navbar">
    <a href="#" class="nav-brand">FAIZI<span>FY</span></a>

    <div class="nav-menu-wrapper">
        <a href="{{ route('admin.dashboard') }}" class="nav-item-link">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <a href="{{ route('admin.transaksi') }}" class="nav-item-link">
            <i class="bi bi-cart-check"></i> Transaksi
        </a>
        <a href="{{ route('admin.finances') }}" class="nav-item-link">
            <i class="bi bi-bar-chart-line"></i> Keuangan
        </a>
        <a href="{{ route('admin.pelanggan') }}" class="nav-item-link active">
            <i class="bi bi-people"></i> Pelanggan
        </a>
       
    </div>

    
        <button type="button" class="btn-logout-nav" onclick="confirmLogout()">
            <i class="bi bi-power fs-5"></i>
        </button>
    </div>
</nav>

<div class="main-container">
    <div class="header-section">
        <div>
            <h1 class="page-title">Data Pelanggan</h1>
            <p class="text-muted small mb-0">Total terdaftar: <strong>{{ $pelanggan->count() }} pengguna</strong></p>
        </div>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Identitas Pengguna</th>
                        <th>Username</th>
                        <th>Kontak</th>
                        <th>Alamat Domisili</th>
                        <th class="text-center">Keamanan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggan as $i => $p)
                    <tr>
                        <td class="text-muted small">{{ $i+1 }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-ui me-3">
                                    {{ strtoupper(substr($p->nama, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="fw-bold" style="color: var(--dark-slate)">{{ $p->nama }}</div>
                                    <div class="text-muted" style="font-size: 12px;">{{ $p->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge-user">@ {{ $p->username }}</span></td>
                        <td class="small fw-500">{{ $p->hp ?? '-' }}</td>
                        <td class="text-muted small" style="max-width: 250px;">
                            {{ Str::limit($p->alamat ?? 'Belum diatur', 45) }}
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn-reset" onclick="confirmReset('{{ $p->id }}', '{{ $p->nama }}')">
                                <i class="bi bi-shield-lock me-1"></i> Reset Password
                            </button>
                            <form id="reset-form-{{ $p->id }}" action="{{ route('admin.pelanggan.resetpw', $p->id) }}" method="POST" style="display: none;">
                                @csrf @method('PUT')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <p class="text-muted fw-bold">Belum ada pelanggan terdaftar.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>

<script>
    // Alert Reset Password (Gaya Ceklis Hijau)
    function confirmReset(id, nama) {
        Swal.fire({
            title: "Konfirmasi Reset",
            text: "Reset password " + nama + " menjadi 'password123'?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2563eb",
            confirmButtonText: "Ya, Reset",
            cancelButtonText: "Batal",
            customClass: { popup: 'rounded-4' }
        }).then((result) => {
            if (result.isConfirmed) {
                // Notifikasi Sukses Persis Gambar
                Swal.fire({
                    title: "Terima kasih!",
                    text: "Password pelanggan berhasil diperbarui.",
                    icon: "success",
                    confirmButtonColor: "#22c55e",
                    confirmButtonText: "Selesai",
                    customClass: { popup: 'rounded-4' }
                }).then(() => {
                    document.getElementById('reset-form-' + id).submit();
                });
            }
        });
    }

    // Alert Logout
    function confirmLogout() {
        Swal.fire({
            title: "Keluar Sesi?",
            text: "Anda akan keluar dari panel administrasi.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#ef4444",
            confirmButtonText: "Keluar",
            cancelButtonText: "Batal",
            customClass: { popup: 'rounded-4' }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
@endsection