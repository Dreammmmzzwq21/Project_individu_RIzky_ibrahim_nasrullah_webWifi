<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $transaksi->id }} - UNDONET</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --red: #dc2626;
            --red-dark: #991b1b;
            --ink: #111827;
            --muted: #64748b;
            --soft: #f8fafc;
            --line: #e5e7eb;
            --green: #16a34a;
            --mono: 'JetBrains Mono', monospace;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            padding: 42px 16px 64px;
            background:
                radial-gradient(circle at top left, rgba(220,38,38,.10), transparent 28rem),
                linear-gradient(180deg, #fff 0%, #f8fafc 42%, #fff 100%);
            color: var(--ink);
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .invoice-shell {
            max-width: 900px;
            margin: 0 auto;
        }

        .invoice-paper {
            overflow: hidden;
            border: 1px solid rgba(226,232,240,.95);
            border-radius: 32px;
            background: #fff;
            box-shadow: 0 24px 70px rgba(15,23,42,.10);
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 34px 38px;
            color: #fff;
            background: linear-gradient(135deg, #111827 0%, #991b1b 58%, #dc2626 100%);
        }

        .hero:after {
            content: 'UNDONET';
            position: absolute;
            right: -16px;
            bottom: -18px;
            color: rgba(255,255,255,.06);
            font-family: var(--mono);
            font-size: 86px;
            font-weight: 700;
            letter-spacing: -5px;
            pointer-events: none;
        }

        .hero-top {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            gap: 26px;
            align-items: flex-start;
        }

        .brand-mark {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,.13);
            border: 1px solid rgba(255,255,255,.18);
            font-size: 24px;
            margin-bottom: 16px;
        }

        .brand-name {
            font-size: 30px;
            font-weight: 900;
            letter-spacing: -.05em;
            line-height: 1;
        }

        .brand-tagline {
            margin-top: 8px;
            color: rgba(255,255,255,.72);
            font-size: 13px;
            line-height: 1.6;
        }

        .invoice-meta {
            min-width: 240px;
            padding: 18px;
            border-radius: 24px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.18);
            backdrop-filter: blur(12px);
            text-align: right;
        }

        .meta-label {
            color: rgba(255,255,255,.62);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .meta-number {
            margin: 6px 0;
            color: #fff;
            font-family: var(--mono);
            font-size: 28px;
            font-weight: 700;
        }

        .meta-date {
            color: rgba(255,255,255,.74);
            font-size: 12px;
        }

        .status-row {
            position: relative;
            z-index: 2;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 28px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,.16);
            background: rgba(255,255,255,.10);
            color: rgba(255,255,255,.80);
            font-size: 12px;
            font-weight: 700;
        }

        .chip.paid {
            color: #86efac;
            background: rgba(22,163,74,.16);
            border-color: rgba(134,239,172,.24);
        }

        .content {
            padding: 34px 38px 38px;
        }

        .summary-band {
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            gap: 18px;
            margin-bottom: 24px;
        }

        .panel {
            border: 1px solid var(--line);
            border-radius: 24px;
            background: #fff;
            overflow: hidden;
        }

        .panel.pad { padding: 22px; }

        .panel-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 16px;
            color: var(--red);
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .10em;
            text-transform: uppercase;
        }

        .info-list {
            display: grid;
            gap: 12px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-row:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .info-key {
            flex-shrink: 0;
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
        }

        .info-val {
            max-width: 62%;
            color: var(--ink);
            font-size: 13px;
            font-weight: 800;
            text-align: right;
            word-break: break-word;
        }

        .payment-card {
            min-height: 100%;
            background:
                radial-gradient(circle at top right, rgba(220,38,38,.12), transparent 12rem),
                #fffafa;
        }

        .total-large-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .total-large {
            margin-top: 8px;
            color: var(--red);
            font-family: var(--mono);
            font-size: 30px;
            font-weight: 700;
            letter-spacing: -.04em;
        }

        .paid-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 16px;
            padding: 9px 13px;
            border-radius: 999px;
            background: #dcfce7;
            color: var(--green);
            font-size: 12px;
            font-weight: 900;
        }

        .items-panel {
            margin-top: 22px;
        }

        .items-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            padding: 20px 22px;
            border-bottom: 1px solid var(--line);
        }

        .items-title {
            font-size: 15px;
            font-weight: 900;
            letter-spacing: -.02em;
        }

        .count-badge {
            padding: 6px 12px;
            border-radius: 999px;
            background: #fff1f2;
            color: var(--red);
            font-size: 11px;
            font-weight: 900;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            padding: 13px 22px;
            background: #f8fafc;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .08em;
            text-align: left;
            text-transform: uppercase;
            border-bottom: 1px solid #f1f5f9;
        }

        tbody td {
            padding: 18px 22px;
            border-bottom: 1px solid #f8fafc;
            vertical-align: middle;
            font-size: 13px;
        }

        tbody tr:last-child td { border-bottom: 0; }
        .th-center, .td-center { text-align: center; }
        .th-right, .td-right { text-align: right; }

        .service-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .service-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: #fff1f2;
            color: var(--red);
            font-size: 18px;
        }

        .service-name {
            font-weight: 900;
            color: var(--ink);
        }

        .muted {
            color: var(--muted);
            font-size: 11px;
            margin-top: 3px;
        }

        .qty {
            display: inline-flex;
            min-width: 34px;
            justify-content: center;
            padding: 5px 10px;
            border-radius: 999px;
            background: #f8fafc;
            border: 1px solid var(--line);
            color: #475569;
            font-weight: 900;
            font-size: 11px;
        }

        .money {
            font-family: var(--mono);
            font-weight: 700;
            color: var(--ink);
        }

        .totals {
            display: flex;
            justify-content: flex-end;
            padding: 22px;
            background: #fffafa;
            border-top: 1px solid var(--line);
        }

        .totals-box {
            width: min(100%, 340px);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            padding: 9px 0;
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
        }

        .total-row.final {
            margin-top: 8px;
            padding-top: 14px;
            border-top: 2px solid #fecaca;
            color: var(--ink);
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .total-row.final .money {
            color: var(--red);
            font-size: 22px;
        }

        .note-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 18px;
            align-items: center;
            margin-top: 22px;
            padding: 20px 22px;
            border: 1px solid var(--line);
            border-radius: 24px;
            background: #fff;
        }

        .note-text {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .verify {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            background: #dcfce7;
            color: var(--green);
            font-size: 12px;
            font-weight: 900;
            white-space: nowrap;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 44px;
            padding: 12px 20px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 900;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .btn-print {
            border: 0;
            background: linear-gradient(135deg, #ef4444, #b91c1c);
            color: #fff;
            box-shadow: 0 14px 32px rgba(220,38,38,.22);
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 38px rgba(220,38,38,.30);
        }

        .btn-back {
            border: 1px solid var(--line);
            background: #fff;
            color: var(--ink);
        }

        .btn-back:hover {
            background: var(--ink);
            color: #fff;
            border-color: var(--ink);
        }

        @media (max-width: 760px) {
            body { padding: 22px 12px 42px; }
            .hero, .content { padding: 26px 22px; }
            .hero-top, .note-row { grid-template-columns: 1fr; }
            .hero-top { flex-direction: column; }
            .invoice-meta { width: 100%; text-align: left; }
            .summary-band { grid-template-columns: 1fr; }
            table { min-width: 680px; }
            .items-panel { overflow-x: auto; }
            .actions { flex-direction: column-reverse; }
            .btn { width: 100%; }
        }

        @media print {
            @page { margin: 10mm 12mm; }
            body { padding: 0; background: #fff; }
            .invoice-shell { max-width: 100%; }
            .invoice-paper { box-shadow: none; border-radius: 0; }
            .actions { display: none !important; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>
</head>
<body>

@php
    $durasiLangganan = max((int) ($transaksi->durasi_langganan ?? 1), 1);
    $subtotalBulanan = $transaksi->details->sum(fn ($d) => $d->produk->harga * $d->jumlah);
    $totalPaketLangganan = $subtotalBulanan * $durasiLangganan;
    $biayaAktivasi = max($transaksi->total_harga - $totalPaketLangganan, 0);
@endphp

<div class="invoice-shell">
    <div class="invoice-paper">
        <section class="hero">
            <div class="hero-top">
                <div>
                    <div class="brand-mark"><i class="bi bi-router"></i></div>
                    <div class="brand-name">UNDONET</div>
                    <div class="brand-tagline">Invoice layanan internet fiber dan aktivasi pelanggan.</div>
                </div>

                <div class="invoice-meta">
                    <div class="meta-label">Invoice</div>
                    <div class="meta-number">#{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</div>
                    <div class="meta-date">{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d F Y') }}</div>
                </div>
            </div>

            <div class="status-row">
                <div class="chip"><i class="bi bi-calendar3"></i>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</div>
                <div class="chip"><i class="bi bi-credit-card"></i>{{ $transaksi->pembayaran ?? '-' }}</div>
                <div class="chip"><i class="bi bi-tools"></i>{{ $transaksi->pengiriman ?? '-' }}</div>
                <div class="chip"><i class="bi bi-calendar-check"></i>{{ $durasiLangganan }} bulan</div>
                <div class="chip paid"><i class="bi bi-check-circle-fill"></i>Lunas</div>
            </div>
        </section>

        <main class="content">
            <div class="summary-band">
                <section class="panel pad">
                    <div class="panel-title"><i class="bi bi-person-circle"></i>Data Pelanggan</div>
                    <div class="info-list">
                        <div class="info-row"><span class="info-key">Nama</span><span class="info-val">{{ $transaksi->pelanggan->nama }}</span></div>
                        <div class="info-row"><span class="info-key">Email</span><span class="info-val">{{ $transaksi->pelanggan->email }}</span></div>
                        <div class="info-row"><span class="info-key">No. HP</span><span class="info-val">{{ $transaksi->pelanggan->hp ?? '-' }}</span></div>
                        <div class="info-row"><span class="info-key">Alamat Pemasangan</span><span class="info-val">{{ $transaksi->pelanggan->alamat ?? '-' }}</span></div>
                    </div>
                </section>

                <section class="panel pad payment-card">
                    <div class="panel-title"><i class="bi bi-receipt"></i>Ringkasan Invoice</div>
                    <div class="total-large-label">Total Tagihan</div>
                    <div class="total-large">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</div>
                    <div class="paid-badge"><i class="bi bi-shield-check"></i>Pembayaran tercatat lunas</div>
                    <div class="info-list" style="margin-top:18px;">
                        <div class="info-row"><span class="info-key">Metode</span><span class="info-val">{{ $transaksi->pembayaran ?? '-' }}</span></div>
                        <div class="info-row"><span class="info-key">Aktivasi</span><span class="info-val">{{ $transaksi->pengiriman ?? '-' }}</span></div>
                        <div class="info-row"><span class="info-key">Durasi</span><span class="info-val">{{ $durasiLangganan }} bulan</span></div>
                    </div>
                </section>
            </div>

            <section class="panel items-panel">
                <div class="items-head">
                    <div>
                        <div class="items-title">Paket Layanan</div>
                        <div class="muted">Detail paket internet yang dipilih pelanggan.</div>
                    </div>
                    <span class="count-badge">{{ $transaksi->details->count() }} item</span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th style="width:44px;">#</th>
                            <th>Paket</th>
                            <th>Harga / Bulan</th>
                            <th class="th-center">Qty</th>
                            <th class="th-right">Subtotal / Bulan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi->details as $i => $d)
                        <tr>
                            <td class="muted">{{ $i + 1 }}</td>
                            <td>
                                <div class="service-cell">
                                    <div class="service-icon"><i class="bi bi-wifi"></i></div>
                                    <div>
                                        <div class="service-name">{{ $d->produk->nama }}</div>
                                        <div class="muted">UNDONET Fiber Service</div>
                                    </div>
                                </div>
                            </td>
                            <td class="money">Rp {{ number_format($d->produk->harga, 0, ',', '.') }}</td>
                            <td class="td-center"><span class="qty">{{ $d->jumlah }}</span></td>
                            <td class="td-right money">Rp {{ number_format($d->produk->harga * $d->jumlah, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="totals">
                    <div class="totals-box">
                        <div class="total-row">
                            <span>Subtotal Paket / Bulan</span>
                            <span class="money">Rp {{ number_format($subtotalBulanan, 0, ',', '.') }}</span>
                        </div>
                        <div class="total-row">
                            <span>Durasi Langganan</span>
                            <span class="money">{{ $durasiLangganan }} bulan</span>
                        </div>
                        <div class="total-row">
                            <span>Total Paket</span>
                            <span class="money">Rp {{ number_format($totalPaketLangganan, 0, ',', '.') }}</span>
                        </div>
                        <div class="total-row">
                            <span>Biaya Aktivasi</span>
                            <span class="money">Rp {{ number_format($biayaAktivasi, 0, ',', '.') }}</span>
                        </div>
                        <div class="total-row">
                            <span>Diskon</span>
                            <span class="money">Rp 0</span>
                        </div>
                        <div class="total-row final">
                            <span>Total</span>
                            <span class="money">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="note-row">
                <div class="note-text">
                    Terima kasih telah memilih <strong>UNDONET</strong>. Invoice ini diterbitkan otomatis oleh sistem dan dapat digunakan sebagai bukti transaksi layanan.
                    <br>Kontak dukungan: hello@undonet.id
                </div>
                <div class="verify"><i class="bi bi-patch-check-fill"></i>Terverifikasi</div>
            </section>
        </main>
    </div>

    <div class="actions">
        <a href="javascript:history.back()" class="btn btn-back"><i class="bi bi-arrow-left"></i>Kembali</a>
        <button onclick="window.print()" class="btn btn-print"><i class="bi bi-printer"></i>Cetak Invoice</button>
    </div>
</div>

<script>
    window.onload = function() {
        window.print();
    }
</script>

</body>
</html>
