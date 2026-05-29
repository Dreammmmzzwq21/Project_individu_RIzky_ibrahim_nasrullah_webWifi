<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Produk; // Sesuaikan dengan nama Model produkmu (biasanya Produk atau TbProduk)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Tampilkan data produk di dashboard admin
    public function index()
    {
        $produk = Produk::all();
        return view('admin.dashboard', compact('produk'));
    }

    // Simpan produk baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string',
            'poto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $potoPath = null;
        if ($request->hasFile('poto')) {
            // Menyimpan file ke storage/app/public/produk
            $potoPath = $request->file('poto')->store('produk', 'public');
        }

        Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'poto' => $potoPath,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Produk baru berhasil ditambahkan!');
    }

    // Update data produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string',
            'poto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $produk = Produk::findOrFail($id);

        if ($request->hasFile('poto')) {
            // Hapus foto lama jika ada ganti baru
            if ($produk->poto) {
                Storage::disk('public')->delete($produk->poto);
            }
            $produk->poto = $request->file('poto')->store('produk', 'public');
        }

        $produk->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'poto' => $produk->poto
        ]);

        return redirect()->back()->with('success', 'Produk berhasil diubah!');
    }

    // Hapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->poto) {
            Storage::disk('public')->delete($produk->poto);
        }

        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}