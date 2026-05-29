<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index()
    {
        // ── 1. TOTAL PENDAPATAN ──────────────────────────────────────────
        // Semua transaksi dianggap selesai (tidak ada kolom status)
        $totalPendapatan = DB::table('tb_transaksi')->sum('total_harga');

        // ── 2. TOTAL TRANSAKSI ───────────────────────────────────────────
        $totalTransaksi = DB::table('tb_transaksi')->count();

        // ── 3. TOTAL PRODUK TERJUAL ──────────────────────────────────────
        $totalProdukTerjual = DB::table('tb_detail')->sum('jumlah');

        // ── 4. RINCIAN PENJUALAN PER PRODUK ─────────────────────────────
        $rincianPenjualan = DB::table('tb_detail')
            ->join('tb_produk', 'tb_detail.id_produk', '=', 'tb_produk.id')
            ->join('tb_transaksi', 'tb_detail.id_transaksi', '=', 'tb_transaksi.id')
            ->select(
                'tb_produk.nama',
                'tb_produk.kategori',
                'tb_produk.harga',
                DB::raw('SUM(tb_detail.jumlah) as qty_terjual'),
                DB::raw('SUM(tb_produk.harga * tb_detail.jumlah) as total_pendapatan')
            )
            ->groupBy('tb_produk.id', 'tb_produk.nama', 'tb_produk.kategori', 'tb_produk.harga')
            ->orderByDesc('qty_terjual')
            ->get();

        // ── 5. GRAFIK PENDAPATAN PER MINGGU (bulan ini) ─────────────────
        $grafikData = DB::table('tb_transaksi')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->select(
                DB::raw('WEEK(created_at, 1) as minggu'),
                DB::raw('SUM(total_harga) as total')
            )
            ->groupBy('minggu')
            ->orderBy('minggu')
            ->get();

        // ── 6. GRAFIK PENDAPATAN 6 BULAN TERAKHIR ───────────────────────
        $grafikBulanan = DB::table('tb_transaksi')
            ->where('created_at', '>=', now()->subMonths(6))
            ->select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('YEAR(created_at) as tahun'),
                DB::raw('SUM(total_harga) as total')
            )
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        return view('admin.finances', compact(
            'totalPendapatan',
            'totalTransaksi',
            'totalProdukTerjual',
            'rincianPenjualan',
            'grafikData',
            'grafikBulanan'
        ));
    }
}