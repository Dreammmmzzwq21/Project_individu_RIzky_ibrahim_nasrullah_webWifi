@extends('layouts.app')

@section('title', 'Kelola Keuangan — UNDONET')

@section('content')
<style>
    body { background: #f4f7fa; }
    .main-content { padding: 30px; }
    .card { border: none; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin-bottom: 30px; }
    .card-header { background: white; border-bottom: 1px solid #edf2f7; padding: 20px; border-radius: 15px 15px 0 0 !important; }
    .table thead th { background: #f8fafc; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; color: #64748b; border: none; }
    .status-pill { padding: 4px 12px; border-radius: 50px; font-size: 12px; font-weight: 600; }
    .bg-profit { background: #dcfce7; color: #166534; }
    .bg-loss { background: #fee2e2; color: #991b1b; }
    .text-money { font-family: 'Monaco', monospace; font-weight: 700; }
    .summary-box { padding: 20px; border-radius: 12px; color: white; }
</style>

<div class="main-content">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="fw-bold text-dark">Laporan Keuangan Perusahaan</h2>
            <p class="text-muted">Periode: {{ now()->translatedFormat('F Y') }}</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="summary-box bg-primary">
                <small>Estimasi Modal Stok (9 Unit)</small>
                <h3 class="text-money">Rp 86.400.000</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-box bg-info">
                <small>Target Omzet Jual</small>
                <h3 class="text-money">Rp 102.900.000</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-box bg-success">
                <small>Proyeksi Laba Bersih</small>
                <h3 class="text-money">Rp 9.500.000</h3>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold"><i class="bi bi-box-seam me-2"></i> Stok & Pengadaan Laptop</h5>
            <span class="badge bg-dark">9 Unit Total</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover m-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Kategori</th>
                            <th>Qty</th>
                            <th>Harga Kulakan (Satuan)</th>
                            <th>Total Modal</th>
                            <th>Target Jual</th>
                            <th class="pe-4">Potensi Laba</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $inventory = [
                                ['nama' => 'Laptop Gaming', 'qty' => 3, 'beli' => 13500000, 'jual' => 16000000],
                                ['nama' => 'Laptop Pelajar', 'qty' => 3, 'beli' => 4800000, 'jual' => 5800000],
                                ['nama' => 'Ultrabook / Karyawan', 'qty' => 3, 'beli' => 10500000, 'jual' => 12500000],
                            ];
                            $totalModalStok = 0;
                        @endphp

                        @foreach($inventory as $item)
                        @php $totalModalStok += ($item['beli'] * $item['qty']); @endphp
                        <tr>
                            <td class="ps-4 fw-bold text-dark">{{ $item['nama'] }}</td>
                            <td>{{ $item['qty'] }} Unit</td>
                            <td class="text-money">Rp {{ number_format($item['beli'], 0, ',', '.') }}</td>
                            <td class="text-money">Rp {{ number_format($item['beli'] * $item['qty'], 0, ',', '.') }}</td>
                            <td class="text-money text-primary">Rp {{ number_format($item['jual'], 0, ',', '.') }}</td>
                            <td class="pe-4"><span class="status-pill bg-profit">+ Rp {{ number_format(($item['jual'] - $item['beli']) * $item['qty'], 0, ',', '.') }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0 fw-bold text-danger"><i class="bi bi-graph-down-arrow me-2"></i> Biaya Operasional (Monthly)</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Komponen Biaya</th>
                                <th class="pe-4 text-end">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $ops = [
                                    'Sewa Tempat/Booth' => 2000000,
                                    'Marketing (Ads/Sosmed)' => 1500000,
                                    'Packing & Safety Tools' => 500000,
                                    'Gaji Sales/Admin' => 2500000,
                                    'Listrik & Internet' => 500000
                                ];
                                $totalOps = array_sum($ops);
                            @endphp
                            @foreach($ops as $label => $harga)
                            <tr>
                                <td class="ps-4">{{ $label }}</td>
                                <td class="pe-4 text-end text-money">Rp {{ number_format($harga, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th class="ps-4">Total Pengeluaran Bulanan</th>
                                <th class="pe-4 text-end text-danger">Rp {{ number_format($totalOps, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0 fw-bold">Analisis Akhir</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Total Laba Kotor Produk</span>
                        <span class="text-success fw-bold">Rp 16.500.000</span>
                    </div>
                    <div cla    ss="d-flex justify-content-between mb-3">
                        <span>Total Biaya Operasional</span>
                        <span class="text-danger fw-bold">- Rp {{ number_format($totalOps, 0, ',', '.') }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold text-dark">Laba Bersih Perusahaan</h5>
                        <h5 class="fw-bold text-primary">Rp {{ number_format(16500000 - $totalOps, 0, ',', '.') }}</h5>
                    </div>
                    <div class="alert alert-info mt-4 border-0">
                        <small><i class="bi bi-info-circle me-1"></i> Catatan: Perhitungan ini mengasumsikan 9 unit laptop terjual habis dalam 1 bulan.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection