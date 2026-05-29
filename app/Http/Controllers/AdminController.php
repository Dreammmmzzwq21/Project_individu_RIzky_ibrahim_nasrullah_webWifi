<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $produk   = Produk::all();
        $kategoris = Produk::select('kategori')->distinct()->get();
        return view('admin.dashboard', compact('produk', 'kategoris'));
    }

    public function storeProduk(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'harga'     => 'required|integer',
            'stok'      => 'required|integer',
            'kategori'  => 'required',
            'deskripsi' => 'nullable',
            'poto'      => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('poto')) {
            $path = $request->file('poto')->store('produk', 'public');
        }

        Produk::create([
            'nama'      => $request->nama,
            'harga'     => $request->harga,
            'stok'      => $request->stok,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'poto'      => $path,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function updateProduk(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $request->validate([
            'nama'     => 'required',
            'harga'    => 'required|integer',
            'stok'     => 'required|integer',
            'kategori' => 'required',
            'poto'     => 'nullable|image|max:2048',
        ]);

        $path = $produk->poto;
        if ($request->hasFile('poto')) {
            if ($path) Storage::disk('public')->delete($path);
            $path = $request->file('poto')->store('produk', 'public');
        }

        $produk->update([
            'nama'      => $request->nama,
            'harga'     => $request->harga,
            'stok'      => $request->stok,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'poto'      => $path,
        ]);

        return back()->with('success', 'Produk berhasil diupdate!');
    }

    public function destroyProduk($id)
    {
        $produk = Produk::findOrFail($id);
        if ($produk->poto) Storage::disk('public')->delete($produk->poto);
        $produk->delete();
        return back()->with('success', 'Produk berhasil dihapus!');
    }

    public function transaksi()
    {
        $transaksi = Transaksi::with('pelanggan')->orderByDesc('created_at')->get();
        return view('admin.transaksi', compact('transaksi'));
    }

    public function detailTransaksi($id)
    {
        $transaksi = Transaksi::with('details.produk', 'pelanggan')->findOrFail($id);
        return view('admin.detail_transaksi', compact('transaksi'));
    }

    public function destroyTransaksi($id)
    {
        Transaksi::findOrFail($id)->delete();
        return back()->with('success', 'Transaksi berhasil dihapus!');
    }

    public function pelanggan()
    {
        $pelanggan = User::where('role', 'pelanggan')->get();
        return view('admin.pelanggan', compact('pelanggan'));
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->update(['password' => Hash::make('password123')]);
        return back()->with('success', 'Password direset ke: password123');
    }

    public function cetakInvoice($id)
    {
        $transaksi = Transaksi::with('details.produk', 'pelanggan')->findOrFail($id);
        return view('admin.invoice', compact('transaksi'));
    }

    // ─── PESAN DARI CONTACT ─────────────────────────────────────

    public function pesan()
    {
        $pesans = \App\Models\Pesan::orderByDesc('created_at')->get();
        return view('admin.pesan', compact('pesans'));
    }

    public function balasPesan(Request $request, $id)
    {
        $request->validate(['balasan' => 'required|string']);
        $pesan = \App\Models\Pesan::findOrFail($id);
        $pesan->update([
            'balasan'    => $request->balasan,
            'dibalas_at' => now(),
        ]);
        return back()->with('success', 'Balasan berhasil disimpan!');
    }

    public function destroyPesan($id)
    {
        \App\Models\Pesan::findOrFail($id)->delete();
        return back()->with('success', 'Pesan berhasil dihapus!');
    }
}