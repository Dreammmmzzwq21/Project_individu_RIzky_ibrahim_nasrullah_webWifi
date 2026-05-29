@extends('layouts.app')
@section('title', 'Keranjang Paket - UNDONET')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&display=swap');

    :root {
        --primary-blue: #dc2626;
        --dark-slate:   #111827;
        --light-bg:     #f8fafc;
        --border-color: #e5e7eb;
        --danger-red:   #dc2626;
        --success-green:#22c55e;
        --text-muted:   #64748b;
        --mono: 'JetBrains Mono', monospace;
    }

    /* ── PAGE ── */
    .cart-page {
        background:
            radial-gradient(circle at top left, rgba(220,38,38,.08), transparent 28rem),
            linear-gradient(180deg, #fff 0%, var(--light-bg) 44%, #fff 100%);
        min-height: 100vh;
        padding: 44px 0 72px;
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .cart-wrap {
        max-width: 1060px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* ── PAGE TITLE ── */
    .page-title {
        font-size: clamp(28px, 4vw, 42px);
        font-weight: 900;
        letter-spacing: -.04em;
        color: var(--dark-slate);
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }

    .page-title i {
        width: 52px; height: 52px;
        background: linear-gradient(135deg, #ef4444, #991b1b);
        color: #fff;
        border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        box-shadow: 0 16px 34px rgba(220,38,38,.22);
    }

    .page-subtitle {
        color: var(--text-muted);
        margin: 0 0 28px 62px;
        font-size: 15px;
        line-height: 1.7;
    }

    /* ── EMPTY STATE ── */
    .empty-card {
        background: white;
        border-radius: 24px;
        border: 1px solid var(--border-color);
        padding: 64px 32px;
        text-align: center;
        box-shadow: 0 18px 55px rgba(15,23,42,.08);
    }

    .empty-icon {
        width: 80px; height: 80px;
        background: #fff1f2;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 32px; color: var(--primary-blue);
        margin: 0 auto 16px;
    }

    .empty-text {
        font-size: 15px; font-weight: 600; color: var(--dark-slate);
        margin-bottom: 6px;
    }

    .empty-sub {
        font-size: 13px; color: var(--text-muted);
        margin-bottom: 24px;
    }

    /* ── GRID ── */
    .cart-grid {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 20px;
        align-items: start;
    }

    /* ── ITEMS CARD ── */
    .items-card {
        background: white;
        border-radius: 26px;
        border: 1px solid var(--border-color);
        overflow: hidden;
        box-shadow: 0 18px 55px rgba(15,23,42,.08);
    }

    .items-card-header {
        padding: 18px 22px;
        border-bottom: 1px solid #f1f5f9;
        display: flex; justify-content: space-between; align-items: center;
    }

    .items-card-title { font-size: 13px; font-weight: 800; color: var(--dark-slate); }

    .count-badge {
        font-size: 11px; font-weight: 700;
        background: #fff1f2; color: var(--primary-blue);
        border: 1px solid var(--border-color);
        padding: 3px 12px; border-radius: 99px;
    }

    table { width: 100%; border-collapse: collapse; }

    thead th {
        background: #fffafa;
        color: #94a3b8;
        font-size: 10px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .06em;
        padding: 11px 18px; text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }
    thead th.th-right { text-align: right; }
    thead th.th-center { text-align: center; }

    tbody td {
        padding: 14px 18px;
        font-size: 13px;
        border-bottom: 1px solid #f8fafc;
        vertical-align: middle;
        color: var(--dark-slate);
    }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover { background: #fffafa; }

    .product-cell { display: flex; align-items: center; gap: 12px; }

    .product-thumb {
        width: 48px; height: 40px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid var(--border-color);
        flex-shrink: 0;
    }

    .product-icon {
        width: 48px; height: 40px;
        border-radius: 10px;
        background: #fff1f2;
        border: 1px solid var(--border-color);
        display: flex; align-items: center; justify-content: center;
        color: var(--primary-blue); font-size: 16px; flex-shrink: 0;
    }

    .product-name { font-size: 13px; font-weight: 700; }

    .qty-badge {
        display: inline-block;
        background: #fff1f2; color: var(--primary-blue);
        border: 1px solid var(--border-color);
        font-size: 11px; font-weight: 700;
        padding: 3px 10px; border-radius: 99px;
    }

    .text-money { font-family: var(--mono); font-weight: 700; }
    .td-muted { color: var(--text-muted); }
    .td-center { text-align: center; }
    .td-right { text-align: right; }
    .td-subtotal { color: var(--dark-slate); font-size: 13.5px; }

    .btn-hapus {
        width: 32px; height: 32px;
        border-radius: 8px;
        border: 1px solid #fecaca;
        background: #fef2f2;
        color: var(--danger-red);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: .15s;
        font-size: 14px;
    }
    .btn-hapus:hover { background: var(--danger-red); color: white; border-color: var(--danger-red); }

    /* ── SUMMARY CARD ── */
    .summary-card {
        background: white;
        border-radius: 26px;
        border: 1px solid var(--border-color);
        overflow: hidden;
        box-shadow: 0 18px 55px rgba(15,23,42,.08);
    }

    .summary-header {
        background: linear-gradient(135deg, #111827, #991b1b 62%, #dc2626);
        padding: 18px 22px;
        position: relative;
        overflow: hidden;
    }

    .summary-header::before {
        content: 'FIBER';
        position: absolute; right: -4px; top: 50%;
        transform: translateY(-50%);
        font-family: var(--mono);
        font-size: 44px; font-weight: 700;
        color: rgba(255,255,255,0.04);
        letter-spacing: -2px;
        pointer-events: none;
    }

    .summary-title {
        font-size: 13px; font-weight: 800;
        color: white;
    }

    .summary-body { padding: 20px 22px; }

    /* ── FORM ELEMENTS ── */
    .field-label {
        font-size: 10px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .12em;
        color: #94a3b8;
        display: flex; align-items: center; gap: 6px;
        margin-bottom: 8px;
    }

    .form-select-custom {
        width: 100%;
        padding: 10px 14px;
        font-family: 'Inter', system-ui, sans-serif;
        font-size: 13px; font-weight: 500;
        color: var(--dark-slate);
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        outline: none;
        transition: border-color .15s;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        cursor: pointer;
    }
    .form-select-custom:focus { border-color: var(--primary-blue); box-shadow: 0 0 0 3px rgba(220,38,38,.10); }

    .field-group { margin-bottom: 16px; }

    /* Info Alamat Box */
    .alamat-profile-box {
        background-color: #fffafa;
        border: 1px dashed #fecaca;
        border-radius: 14px;
        padding: 12px;
        font-size: 12.5px;
        color: var(--dark-slate);
    }

    /* ── COST ROWS ── */
    .divider { border: none; border-top: 1px solid #f1f5f9; margin: 16px 0; }

    .cost-row {
        display: flex; justify-content: space-between; align-items: baseline;
        padding: 6px 0;
        font-size: 13px;
    }

    .cost-key { color: var(--text-muted); font-weight: 500; }
    .cost-val { font-family: var(--mono); font-weight: 700; color: var(--dark-slate); }

    .cost-total-row {
        display: flex; justify-content: space-between; align-items: baseline;
        padding: 14px 0 0;
        border-top: 2px solid #fecaca;
        margin-top: 8px;
    }

    .cost-total-key {
        font-size: 12px; font-weight: 800;
        text-transform: uppercase; letter-spacing: .06em;
        color: var(--dark-slate);
    }

    .cost-total-val {
        font-family: var(--mono);
        font-size: 20px; font-weight: 700;
        color: var(--primary-blue);
    }

    /* ── BUTTONS ── */
    .btn-beli {
        width: 100%;
        padding: 13px;
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        color: white;
        border: none;
        border-radius: 999px;
        font-family: 'Inter', system-ui, sans-serif;
        font-size: 13.5px; font-weight: 800;
        cursor: pointer; transition: .2s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        margin-top: 18px;
        box-shadow: 0 14px 32px rgba(220,38,38,.24);
    }
    .btn-beli:hover { color:white; transform: translateY(-2px); box-shadow: 0 18px 38px rgba(220,38,38,.32); }

    .btn-lanjut {
        width: 100%;
        padding: 11px;
        background: white;
        color: var(--dark-slate);
        border: 1px solid var(--border-color);
        border-radius: 999px;
        font-family: 'Inter', system-ui, sans-serif;
        font-size: 13px; font-weight: 800;
        cursor: pointer; transition: .2s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        margin-top: 10px;
        text-decoration: none;
    }
    .btn-lanjut:hover { background: var(--dark-slate); color: white; border-color: var(--dark-slate); }

    /* ── RESPONSIVE ── */
    @media (max-width: 768px) {
        .cart-grid { grid-template-columns: 1fr; }
        .cart-wrap { padding: 0 12px; }
    }

    /* ── SweetAlert2 custom ── */
    .swal-popup {
        border-radius: 20px !important;
        font-family: 'Inter', system-ui, sans-serif !important;
        padding: 32px 28px 24px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 8px 40px rgba(0,0,0,.10) !important;
    }
    .swal2-title {
        font-size: 17px !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        padding: 0 !important;
        margin-bottom: 6px !important;
    }
    .swal2-html-container {
        font-size: 13px !important;
        color: #64748b !important;
        margin: 0 !important;
    }
    .swal2-actions { gap: 10px !important; margin-top: 20px !important; }
    .swal2-confirm, .swal2-cancel {
        border-radius: 10px !important;
        font-family: 'Inter', system-ui, sans-serif !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        padding: 10px 22px !important;
        border: none !important;
    }
    .swal2-cancel {
        background: #f1f5f9 !important;
        color: #475569 !important;
    }
    .swal2-cancel:hover { background: #e2e8f0 !important; }
    .swal2-icon { margin: 0 auto 16px !important; }
    
    .swal-detail-row {
        display: flex; justify-content: space-between;
        padding: 7px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13px;
    }
    .swal-detail-row:last-child { border-bottom: none; }
    .swal-detail-key { color: #64748b; font-weight: 500; }
    .swal-detail-val { font-weight: 700; color: #0f172a; text-align: right; }

    .swal-popup-custom {
        border-radius: 12px !important;
        font-family: 'Inter', system-ui, sans-serif !important;
        padding: 40px 30px !important;
        width: 420px !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
    }

    .swal-btn-ok {
        background-color: #dc2626 !important;
        color: white !important;
        border: none !important;
        border-radius: 6px !important;
        padding: 10px 0 !important;
        width: 140px !important;
        text-align: center !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        cursor: pointer;
        margin-top: 15px !important;
        display: inline-block !important;
        box-shadow: 0 10px 20px rgba(220,38,38,0.22);
        transition: background 0.2s ease;
    }
    .swal-btn-ok:hover { background-color: #b91c1c !important; }
</style>

<div class="cart-page">
    <div class="cart-wrap">

        {{-- PAGE TITLE --}}
        <div class="page-title">
            <i class="bi bi-router"></i>
            Keranjang Paket
        </div>
        <p class="page-subtitle">Tinjau paket internet UNDONET yang dipilih sebelum lanjut ke proses aktivasi layanan.</p>

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="alert alert-success rounded-3 mb-3" style="font-size:13px;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger rounded-3 mb-3" style="font-size:13px;">{{ session('error') }}</div>
        @endif

        @if(empty($keranjang))
        {{-- EMPTY STATE --}}
        <div class="empty-card">
            <div class="empty-icon"><i class="bi bi-cart-x"></i></div>
            <div class="empty-text">Keranjang kamu kosong</div>
            <div class="empty-sub">Pilih paket internet UNDONET yang sesuai untuk rumah atau bisnismu.</div>
            <a href="{{ route('home') }}" class="btn-beli" style="width:auto;display:inline-flex;padding:12px 28px;text-decoration:none;">
                <i class="bi bi-wifi"></i> Pilih Paket
            </a>
        </div>

        @else
        @php $total = collect($keranjang)->sum(fn($i) => $i['harga'] * $i['jumlah']); @endphp

        <div class="cart-grid">

            {{-- ── ITEMS CARD ── --}}
            <div class="items-card">
                <div class="items-card-header">
                    <span class="items-card-title">Paket dalam Keranjang</span>
                    <span class="count-badge">{{ count($keranjang) }} item</span>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paket</th>
                            <th class="th-right">Harga</th>
                            <th class="th-center">Qty</th>
                            <th class="th-right">Subtotal</th>
                            <th class="th-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keranjang as $i => $item)
                        <tr>
                            <td style="color:#94a3b8;font-size:11px;font-weight:700;width:28px;">{{ $i + 1 }}</td>
                            <td>
                                <div class="product-cell">
                                    @if($item['poto'])
                                        <img src="{{ asset('storage/'.$item['poto']) }}" class="product-thumb" alt="{{ $item['nama'] }}">
                                    @else
                                        <div class="product-icon"><i class="bi bi-router"></i></div>
                                    @endif
                                    <span class="product-name">{{ $item['nama'] }}</span>
                                </div>
                            </td>
                            <td class="td-right td-muted text-money">
                                Rp {{ number_format($item['harga'],0,',','.') }}
                            </td>
                            <td class="td-center">
                                <span class="qty-badge">{{ $item['jumlah'] }}</span>
                            </td>
                            <td class="td-right td-subtotal text-money">
                                Rp {{ number_format($item['harga'] * $item['jumlah'],0,',','.') }}
                            </td>
                            <td class="td-center">
                                <form class="form-hapus" action="{{ route('pelanggan.keranjang.hapus') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_produk" value="{{ $item['id'] }}">
                                    <button type="button" class="btn-hapus btn-hapus-item" data-nama="{{ $item['nama'] }}">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- ── SUMMARY CARD ── --}}
            <div class="summary-card">
                <div class="summary-header">
                    <div class="summary-title">Ringkasan Aktivasi</div>
                </div>
                <div class="summary-body">

                    <form id="formCheckout" action="{{ route('pelanggan.keranjang.beli') }}" method="POST">
                        @csrf

                        {{-- Data Otomatis dari Profil Tersembunyi (Hidden Input) --}}
                        <input type="hidden" name="nama_penerima" value="{{ Auth::user()->nama }}">
                        <input type="hidden" name="no_hp" value="{{ Auth::user()->hp }}">
                        <input type="hidden" name="alamat" value="{{ Auth::user()->alamat }}">

                        {{-- Tampilan Visual Alamat Profil --}}
                        <div class="field-group">
                            <div class="field-label">
                                <i class="bi bi-geo-alt-fill"></i> Alamat Pemasangan
                            </div>
                            <div class="alamat-profile-box">
                                <strong class="d-block text-dark">{{ Auth::user()->nama }}</strong>
                                <span class="text-secondary small d-block mb-1">{{ Auth::user()->hp ?? 'No. HP Belum Diatur' }}</span>
                                <p class="mb-0 text-muted small" style="line-height: 1.4;">
                                    {{ Auth::user()->alamat ?? 'Alamat pemasangan belum diatur di profil Anda.' }}
                                </p>
                                @if(!Auth::user()->alamat || !Auth::user()->hp)
                                    <a href="{{ route('pelanggan.profil') }}" class="text-danger fw-bold d-block mt-2 small text-decoration-none">
                                        <i class="bi bi-pencil-square"></i> Lengkapi Profil Terlebih Dahulu!
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Pilihan Aktivasi --}}
                        <div class="field-group">
                            <div class="field-label">
                                <i class="bi bi-tools"></i> Jadwal Aktivasi
                            </div>
                            <select name="pengiriman" id="selectPengiriman" class="form-select-custom" required onchange="hitungTotal()">
                                <option value="">- Pilih Jadwal Aktivasi -</option>
                                <option value="Instalasi Reguler|15000">Instalasi Reguler - Rp 15.000</option>
                                <option value="Instalasi Prioritas|25000">Instalasi Prioritas (1 Hari) - Rp 25.000</option>
                                <option value="Survey Lokasi|12000">Survey Lokasi - Rp 12.000</option>
                                <option value="Aktivasi Teknisi|13000">Aktivasi Teknisi - Rp 13.000</option>
                                <option value="Ambil Perangkat Sendiri|0">Ambil Perangkat Sendiri (Gratis)</option>
                            </select>
                        </div>

                        {{-- Durasi Langganan --}}
                        <div class="field-group">
                            <div class="field-label">
                                <i class="bi bi-calendar-check"></i> Durasi Langganan
                            </div>
                            <select name="durasi_langganan" id="selectDurasi" class="form-select-custom" required onchange="hitungTotal()">
                                <option value="">- Pilih Durasi -</option>
                                <option value="1">1 Bulan</option>
                                <option value="3">3 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="12">12 Bulan</option>
                                <option value="24">24 Bulan</option>
                            </select>
                        </div>

                        {{-- Pilihan Pembayaran --}}
                        <div class="field-group">
                            <div class="field-label">
                                <i class="bi bi-credit-card"></i> Cara Pembayaran
                            </div>
                            <select name="pembayaran" class="form-select-custom" required>
                                <option value="">- Pilih Pembayaran -</option>
                                <option value="Transfer Bank BCA">Transfer Bank BCA</option>
                                <option value="Transfer Bank BRI">Transfer Bank BRI</option>
                                <option value="Transfer Bank Mandiri">Transfer Bank Mandiri</option>
                                <option value="QRIS">QRIS</option>
                                <option value="COD (Bayar di Tempat)">Bayar ke Teknisi</option>
                            </select>
                        </div>

                        <hr class="divider">

                        {{-- Cost rows --}}
                        <div class="cost-row">
                            <span class="cost-key">Subtotal Paket / Bulan</span>
                            <span class="cost-val">Rp {{ number_format($total,0,',','.') }}</span>
                        </div>
                        <div class="cost-row">
                            <span class="cost-key">Durasi Langganan</span>
                            <span class="cost-val" id="durasiText">-</span>
                        </div>
                        <div class="cost-row">
                            <span class="cost-key">Total Paket</span>
                            <span class="cost-val" id="totalPaket">Rp {{ number_format($total,0,',','.') }}</span>
                        </div>
                        <div class="cost-row">
                            <span class="cost-key">Biaya Aktivasi</span>
                            <span class="cost-val" id="ongkir">Rp 0</span>
                        </div>
                        <div class="cost-row">
                            <span class="cost-key">Diskon</span>
                            <span class="cost-val">Rp 0</span>
                        </div>

                        <div class="cost-total-row">
                            <span class="cost-total-key">Total Bayar</span>
                            <span class="cost-total-val" id="totalBayar">
                                Rp {{ number_format($total,0,',','.') }}
                            </span>
                        </div>

                        <input type="hidden" name="total_akhir" id="inputTotalAkhir" value="{{ $total }}">

                        {{-- Tombol Beli Dinonaktifkan Otomatis jika Profil Kosong --}}
                        <button type="button" id="btnBeli" class="btn-beli" {{ (!Auth::user()->alamat || !Auth::user()->hp) ? 'disabled style=opacity:0.5;cursor:not-allowed;' : '' }}>
                            <i class="bi bi-wifi"></i> Ajukan Aktivasi
                        </button>
                    </form>

                    <a href="{{ route('home') }}" class="btn-lanjut">
                        <i class="bi bi-arrow-left"></i> Lihat Paket Lain
                    </a>

                </div>
            </div>

        </div>{{-- end cart-grid --}}
        @endif

    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

<script>
    const subtotal = {{ $total ?? 0 }};

    function hitungTotal() {
        const val       = document.getElementById('selectPengiriman').value;
        const durasiVal = document.getElementById('selectDurasi').value;
        const durasi    = durasiVal ? parseInt(durasiVal) : 1;
        const ongkir    = val ? parseInt(val.split('|')[1]) : 0;
        const paket     = subtotal * durasi;
        const total     = paket + ongkir;
        document.getElementById('durasiText').textContent = durasiVal ? durasi + ' bulan' : '-';
        document.getElementById('totalPaket').textContent = 'Rp ' + paket.toLocaleString('id-ID');
        document.getElementById('ongkir').textContent     = 'Rp ' + ongkir.toLocaleString('id-ID');
        document.getElementById('totalBayar').textContent= 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('inputTotalAkhir').value = total;
    }

    /* ── CHECKOUT WITH PROFILE VALIDATION ── */
    document.getElementById('btnBeli')?.addEventListener('click', function () {
        const form          = document.getElementById('formCheckout');
        const selPengiriman = form.querySelector('[name="pengiriman"]');
        const selDurasi     = form.querySelector('[name="durasi_langganan"]');
        const selPembayaran = form.querySelector('[name="pembayaran"]');
        
        // Ambil data dari hidden input untuk SweetAlert2
        const namaPenerima  = form.querySelector('[name="nama_penerima"]').value;
        const noHp          = form.querySelector('[name="no_hp"]').value;
        const alamat        = form.querySelector('[name="alamat"]').value;

        if (!selPengiriman.value || !selDurasi.value || !selPembayaran.value) {
            Swal.fire({
                icon: 'warning',
                title: 'Belum Lengkap!',
                text: 'Silakan pilih jadwal aktivasi, durasi langganan, dan pembayaran terlebih dahulu.',
                confirmButtonText: 'Oke, Mengerti',
                confirmButtonColor: '#dc2626',
                customClass: { popup: 'swal-popup' },
            });
            return;
        }

        const namaKirim = selPengiriman.value.split('|')[0];
        const ongkirVal = parseInt(selPengiriman.value.split('|')[1]);
        const durasiVal = parseInt(selDurasi.value);
        const namaBayar = selPembayaran.value;
        const totalPaketText = document.getElementById('totalPaket').textContent.trim();
        const totalText = document.getElementById('totalBayar').textContent.trim();

        // 1. Alert Konfirmasi Detail Aktivasi
        Swal.fire({
            title: 'Konfirmasi Aktivasi',
            html: `
                <div style="text-align:left;margin-top:4px;">
                    <div class="swal-detail-row">
                        <span class="swal-detail-key">Pelanggan</span>
                        <span class="swal-detail-val">${namaPenerima}</span>
                    </div>
                    <div class="swal-detail-row">
                        <span class="swal-detail-key">No. HP</span>
                        <span class="swal-detail-val">${noHp}</span>
                    </div>
                    <div class="swal-detail-row">
                        <span class="swal-detail-key">Alamat</span>
                        <span class="swal-detail-val">${alamat}</span>
                    </div>
                    <div class="swal-detail-row">
                        <span class="swal-detail-key">Aktivasi</span>
                        <span class="swal-detail-val">${namaKirim}</span>
                    </div>
                    <div class="swal-detail-row">
                        <span class="swal-detail-key">Durasi</span>
                        <span class="swal-detail-val">${durasiVal} bulan</span>
                    </div>
                    <div class="swal-detail-row">
                        <span class="swal-detail-key">Total Paket</span>
                        <span class="swal-detail-val">${totalPaketText}</span>
                    </div>
                    <div class="swal-detail-row">
                        <span class="swal-detail-key">Biaya Aktivasi</span>
                        <span class="swal-detail-val">Rp ${ongkirVal.toLocaleString('id-ID')}</span>
                    </div>
                    <div class="swal-detail-row">
                        <span class="swal-detail-key">Pembayaran</span>
                        <span class="swal-detail-val">${namaBayar}</span>
                    </div>
                    <div class="swal-detail-row" style="border-top:2px solid #0f172a;margin-top:8px;padding-top:12px;">
                        <span class="swal-detail-key" style="font-weight:800;color:#0f172a;font-size:13px;text-transform:uppercase;letter-spacing:.04em;">Total Bayar</span>
                        <span class="swal-detail-val" style="color:#dc2626;font-family:'JetBrains Mono',monospace;font-size:17px;">${totalText}</span>
                    </div>
                </div>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '<i class="bi bi-wifi me-1"></i> Ya, Ajukan Aktivasi',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc2626',
            reverseButtons: true,
            customClass: { popup: 'swal-popup' },
        }).then((result) => {
            if (result.isConfirmed) {
                // 2. Tampilkan Alert Sukses Custom sebelum submit ke backend
                Swal.fire({
                    html: `
                        <div style="text-align:center;padding:10px 0;">
                            <div style="width:80px;height:80px;border:4px solid #eefbf3;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;background:#f4fbf7;">
                                <i class="bi bi-check-lg" style="font-size:40px;color:#22c55e;"></i>
                            </div>
                            <h2 style="font-size:26px;font-weight:800;color:#111827;margin-bottom:10px;font-family:'Inter',sans-serif;">Aktivasi Diajukan!</h2>
                            <p style="font-size:14px;color:#64748b;margin-bottom:5px;line-height:1.5;">Terima kasih sudah memilih UNDONET.<br>Permintaan aktivasi layanan sedang kami proses.</p>
                        </div>`,
                    confirmButtonText: 'OK',
                    customClass: { popup: 'swal-popup-custom', confirmButton: 'swal-btn-ok' },
                    buttonsStyling: false,
                }).then(() => { form.submit(); });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    icon: 'info',
                    title: 'Aktivasi Dibatalkan',
                    text: 'Pengajuan belum diproses. Kamu bisa melanjutkan aktivasi kapan saja.',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#64748b',
                    customClass: { popup: 'swal-popup' },
                });
            }
        });
    });
</script>
@endpush
@endsection
