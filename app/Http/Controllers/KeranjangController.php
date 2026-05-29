<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        return view('pelanggan.keranjang', compact('keranjang'));
    }

    public function tambah(Request $request)
    {
        $produk = Produk::findOrFail($request->id_produk);
        $keranjang = session()->get('keranjang', []);
        $id = $request->id_produk;

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] += $request->jumlah ?? 1;
        } else {
            $keranjang[$id] = [
                'id'     => $produk->id,
                'nama'   => $produk->nama,
                'harga'  => $produk->harga,
                'poto'   => $produk->poto,
                'jumlah' => $request->jumlah ?? 1,
            ];
        }

        session()->put('keranjang', $keranjang);
        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function hapus(Request $request)
    {
        $keranjang = session()->get('keranjang', []);
        unset($keranjang[$request->id_produk]);
        session()->put('keranjang', $keranjang);
        return back()->with('success', 'Produk dihapus dari keranjang!');
    }

   public function beli(Request $request)
{
    $keranjang = session()->get('keranjang', []);
    if (empty($keranjang)) return back()->with('error', 'Keranjang kosong!');

    $request->validate([
        'pengiriman' => 'required',
        'pembayaran' => 'required',
        'durasi_langganan' => 'required|integer|min:1|max:24',
    ]);

    $pengirimanParts = explode('|', $request->pengiriman);
    $pengiriman = $pengirimanParts[0];
    $biayaAktivasi = isset($pengirimanParts[1]) ? (int) $pengirimanParts[1] : 0;
    $durasiLangganan = (int) $request->durasi_langganan;
    $subtotalPaket = collect($keranjang)->sum(fn ($item) => $item['harga'] * $item['jumlah']);
    $total = ($subtotalPaket * $durasiLangganan) + $biayaAktivasi;

    $transaksi = Transaksi::create([
        'id_pelanggan' => Auth::id(),
        'tanggal'      => now()->toDateString(),
        'total_harga'  => $total,
        'pengiriman'   => $pengiriman,
        'pembayaran'   => $request->pembayaran,
        'durasi_langganan' => $durasiLangganan,
    ]);

    foreach ($keranjang as $item) {
        Detail::create([
            'id_transaksi' => $transaksi->id,
            'id_produk'    => $item['id'],
            'jumlah'       => $item['jumlah'],
        ]);

        Produk::where('id', $item['id'])->decrement('stok', $item['jumlah']);
    }

    session()->forget('keranjang');
    return redirect()->route('pelanggan.invoice', $transaksi->id);
}
}
