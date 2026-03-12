<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\UlasanBukuController;
use App\Http\Controllers\LaporanController;


Route::get('/', fn() => redirect('/login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');

    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/ulasan', [UlasanBukuController::class, 'index'])->name('ulasan.index');
    Route::post('/ulasan/store', [UlasanBukuController::class, 'store'])->name('ulasan.store');

    Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'show']);
    Route::post('/koleksi/tambah', [PeminjamanController::class, 'tambahKoleksi'])->name('koleksi.store');
    Route::get('/koleksi-saya', [PeminjamanController::class, 'koleksiSaya'])->name('koleksi.index');
    Route::delete('/koleksi/{id}', [PeminjamanController::class, 'hapusKoleksi'])->name('koleksi.destroy');

    Route::middleware(['checkRole:administrator,petugas'])->group(function () {
        Route::get('/laporan', [LaporanController::class, 'generate'])->name('laporan.generate');
        Route::get('/laporan/cetak', [BukuController::class, 'cetak_pdf'])->name('buku.cetak');

        Route::resource('kategori', KategoriBukuController::class);
        Route::delete('/kategori/{id}', [KategoriBukuController::class, 'destroy'])->name('kategori.destroy');
        Route::resource('buku', BukuController::class)->except(['index']);

        Route::put('/peminjaman/{id}/kembali', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembali');
        Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    });

    Route::middleware(['checkRole:peminjam'])->group(function () {
        Route::get('/pinjaman-saya', [PeminjamanController::class, 'pinjamanSaya'])->name('peminjam.pinjaman');
        Route::post('/pinjam-buku/{id}', [PeminjamanController::class, 'store'])->name('peminjam.store');
    });

    Route::middleware(['checkRole:administrator'])->group(function () {
        Route::resource('petugas', PetugasController::class);
    });
});