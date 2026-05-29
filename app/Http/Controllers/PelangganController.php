<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->kategori;
        $cari     = $request->cari;

        $produk = Produk::when($kategori, fn($q) => $q->where('kategori', $kategori))
                        ->when($cari, fn($q) => $q->where('nama', 'like', "%{$cari}%")
                                                   ->orWhere('deskripsi', 'like', "%{$cari}%")
                                                   ->orWhere('kategori', 'like', "%{$cari}%"))
                        ->where('stok', '>', 0)
                        ->get();

        $kategoris = Produk::select('kategori')->distinct()->get();
        return view('pelanggan.index', compact('produk', 'kategoris', 'kategori', 'cari'));
    }

    public function search(Request $request)
    {
        $cari      = $request->q ?? $request->cari ?? '';
        $kategori  = null;

        $produk = Produk::where('stok', '>', 0)
                        ->where(function($q) use ($cari) {
                            $q->where('nama', 'like', "%{$cari}%")
                              ->orWhere('deskripsi', 'like', "%{$cari}%")
                              ->orWhere('kategori', 'like', "%{$cari}%");
                        })
                        ->get();

        $kategoris = Produk::select('kategori')->distinct()->get();
        return view('pelanggan.index', compact('produk', 'kategoris', 'kategori', 'cari'));
    }

    public function profil()
    {
        $transaksi = Transaksi::where('id_pelanggan', Auth::id())
                              ->with('details.produk')
                              ->orderByDesc('created_at')
                              ->get();
        return view('pelanggan.profil', compact('transaksi'));
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama'          => 'required|string|max:255',
            'username'      => 'required|unique:tb_user,username,' . $user->id,
            'email'         => 'required|email|unique:tb_user,email,' . $user->id,
            'hp'            => 'nullable|string',
            'jenis_kelamin' => 'nullable|in:L,P',
            'bio'           => 'nullable|string|max:500',
            'alamat'        => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'password'      => 'nullable|min:6|confirmed',
        ]);

        // Menggunakan penugasan objek langsung agar kebal dari proteksi $fillable
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->hp = $request->hp;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->bio = $request->bio;
        $user->alamat = $request->alamat;

        // Logika simpan gambar profil ke storage lokal
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika memang ada filenya
            if ($user->foto && file_exists(public_path('uploads/profil/' . $user->foto))) {
                unlink(public_path('uploads/profil/' . $user->foto));
            }

            $file = $request->file('foto');
            $namaFoto = $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profil'), $namaFoto);
            
            // Set nama foto baru ke objek user
            $user->foto = $namaFoto;
        }

        // Logika ganti password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan permanen perubahan ke database
        $user->save();

        // Mengembalikan pesan sukses khusus agar ditangkap SweetAlert2
        return back()->with('success', 'Gambar telah di ubah');
    }

    public function cetakInvoice($id)
    {
        $transaksi = Transaksi::with('details.produk', 'pelanggan')
                              ->where('id_pelanggan', Auth::id())
                              ->findOrFail($id);
        return view('pelanggan.invoice', compact('transaksi'));
    }
}