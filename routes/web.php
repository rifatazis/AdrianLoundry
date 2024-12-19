<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PemasukanController;
use App\Models\Layanan;

// Route halaman login
Route::get('/', function () {
    return view('auth/halamanLogin');
});

// Authentication Routes
Route::get('halamanLogin', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('halamanLogin', [AuthController::class, 'login']);
Route::get('halamanRegister', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('halamanRegister', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Administrator Routes
Route::get('administrator/halamanUtama', function () {
    return view('administrator.halamanUtama');
})->middleware(['auth', 'role:administrator'])->name('administrator.halamanUtama');

// Pelanggan Routes
Route::get('pelanggan/halamanUtama', function () {
    return view('pelanggan.halamanUtama');
})->middleware(['auth', 'role:pelanggan'])->name('pelanggan.halamanUtama');

// Halaman utama
Route::get('/halamanUtama', function () {
    return view('administrator.halamanUtama');
})->name('halamanUtama');
Route::get('/halamanUtama', [LayananController::class, 'halamanUtama'])->name('halamanUtama');


// Layanan Routes
Route::resource('layanan', LayananController::class);
Route::get('layanan/{id}', [LayananController::class, 'show'])->name('layanan.show');
Route::get('/mengelolaLayananDanHarga', [LayananController::class, 'index'])->name('mengelolaLayananDanHarga');

// Pesanan Routes
Route::get('/tambahPesanan', [PesananController::class, 'tambahPesanan'])->name('tambahPesanan');
Route::post('/tambahPesanan', [PesananController::class, 'store'])->name('tambahPesanan.store');
Route::get('/statusPesanan', [PesananController::class, 'statusPesanan'])->name('statusPesanan');
Route::patch('/pesanan/{id}/ubah-status', [PesananController::class, 'ubahStatusPesanan'])->name('ubahStatusPesanan');

// Keuangan Routes
Route::get('/keuangan', [PesananController::class, 'dataPemasukan'])->name('keuangan');
Route::get('/data-pemasukan', [KeuanganController::class, 'index'])->name('data.pemasukan');

// Status Pesanan Routes
Route::get('/lihatStatusPesanan', [PesananController::class, 'lihatStatusPesanan'])->name('lihatStatusPesanan');
Route::get('/pesanan/cari', [PesananController::class, 'cari'])->name('pesanan.cari');
Route::get('/lihatStatistik', [PesananController::class, 'statistik'])->name('lihatStatistik');
Route::get('/pesanan/carii', [PesananController::class, 'carii'])->name('pesanan.carii');
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
