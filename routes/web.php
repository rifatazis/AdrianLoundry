<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KeuanganController;
use App\Models\Layanan;

// Route halaman login
Route::get('/', function () {
    return view('auth/HalamanLogin');
});

// Authentication Routes
Route::get('HalamanLogin', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('HalamanLogin', [AuthController::class, 'login']);
Route::get('HalamanRegister', [AuthController::class, 'tampilRegister'])->name('register');
Route::post('HalamanRegister', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Group routes for Administrator with 'auth' and 'role:administrator' middleware
Route::middleware(['auth', 'role:administrator'])->prefix('administrator')->group(function () {

    // Halaman Utama Administrator
    Route::get('HalamanUtamaAdministrator', [LayananController::class, 'halamanUtama'])->name('administrator.HalamanUtamaAdministrator');
    
    // Kelola Layanan
    Route::get('HalamanKelolaLayanan', [LayananController::class, 'index'])->name('HalamanKelolaLayanan');

    // Pesanan Routes
    Route::get('HalamanTambahPesanan', [PesananController::class, 'tambahPesanan'])->name('HalamanTambahPesanan');
    Route::post('HalamanTambahPesanan', [PesananController::class, 'store'])->name('HalamanTambahPesanan.store');
    Route::resource('layanan', LayananController::class);
    Route::get('HalamanUbahStatusPesanan', [PesananController::class, 'statusPesanan'])->name('HalamanUbahStatusPesanan');
    
    // Keuangan Routes
    Route::get('HalamanLihatDataPemasukan', [KeuanganController::class, 'dataPemasukan'])->name('HalamanLihatDataPemasukan');
    Route::get('data-pemasukan', [KeuanganController::class, 'dataPemasukan'])->name('data.pemasukan');
    Route::get('HalamanLihatStatistik', [KeuanganController::class, 'statistik'])->name('HalamanLihatStatistik');

    // Status Pesanan Routes
    Route::get('HalamanLihatStatusPesanan', [PesananController::class, 'lihatStatusPesanan'])->name('HalamanLihatStatusPesanan');
    Route::get('pesanan/cari', [PesananController::class, 'cari'])->name('pesanan.cari');
    Route::get('pesanan', [PesananController::class, 'index'])->name('pesanan.index');
});

// Group routes for Pelanggan with 'auth' and 'role:pelanggan' middleware
Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->group(function () {

    // Halaman Utama Pelanggan
    Route::get('HalamanUtama', function () {
        return view('pelanggan.HalamanUtama');
    })->name('pelanggan.HalamanUtama');
});

// Pesanan Routes (can be used globally)
Route::get('/pesanan/carii', [PesananController::class, 'carii'])->name('pesanan.carii');
Route::resource('layanan', LayananController::class);
Route::patch('pesanan/{id}/ubah-status', [PesananController::class, 'ubahStatusPesanan'])->name('ubahStatusPesanan');


// Unauthorized Route
Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');
