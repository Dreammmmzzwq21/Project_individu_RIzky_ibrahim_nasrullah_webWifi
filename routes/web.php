<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\admin\ProdukController; // Controller produk baru
use App\Http\Controllers\Admin\FinanceController; 

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [PelangganController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


/*
|-----------------------------------------a---------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/

Route::get('/search', [PelangganController::class, 'search'])->name('search');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Finances
    Route::get('/finances', [FinanceController::class, 'index'])->name('finances');

    // Products (SUDAH DIUBAH: Mengarah ke ProdukController dengan method standar store, update, destroy)
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // Transactions
    Route::get('/transaksi', [AdminController::class, 'transaksi'])->name('transaksi');
    Route::get('/transaksi/{id}', [AdminController::class, 'detailTransaksi'])->name('transaksi.detail');
    Route::delete('/transaksi/{id}', [AdminController::class, 'destroyTransaksi'])->name('transaksi.destroy');

    // Customers
    Route::get('/pelanggan', [AdminController::class, 'pelanggan'])->name('pelanggan');
    Route::put('/pelanggan/{id}/reset-pw', [AdminController::class, 'resetPassword'])->name('pelanggan.resetpw');

    // Invoice
    Route::get('/invoice/{id}', [AdminController::class, 'cetakInvoice'])->name('invoice');

});

/*
|--------------------------------------------------------------------------
| PELANGGAN
|--------------------------------------------------------------------------
*/

Route::middleware('pelanggan')->name('pelanggan.')->group(function () {

    Route::get('/katalog', [PelangganController::class, 'index'])->name('index');

    // Keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::post('/keranjang/hapus', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
    Route::post('/keranjang/beli', [KeranjangController::class, 'beli'])->name('keranjang.beli');

    // Profil
    Route::get('/profil', [PelangganController::class, 'profil'])->name('profil');
    Route::put('/profil', [PelangganController::class, 'updateProfil'])->name('profil.update');

    // Invoice
    Route::get('/invoice/{id}', [PelangganController::class, 'cetakInvoice'])->name('invoice');
});