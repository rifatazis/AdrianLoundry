<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PemasukanController;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('administrator/dashboard', function () {
    return view('administrator.dashboard');
})->middleware(['auth', 'role:administrator'])->name('administrator.dashboard');

Route::get('pelanggan/dashboard', function () {
    return view('pelanggan.dashboard');
})->middleware(['auth', 'role:pelanggan'])->name('pelanggan.dashboard');

Route::get('/dashboard', function () {
    return view('administrator.dashboard');
})->name('dashboard');
 
Route::resource('layanan', LayananController::class); 


Route::get('/mengelolaLayananDanHarga', [LayananController::class, 'index'])->name('mengelolaLayananDanHarga');

Route::get('/administrator/mengelola-layanan-dan-harga', [LayananController::class, 'index'])
    ->name('administrator.mengelolaLayananDanHarga');

Route::get('/tambahPesanan', [PesananController::class, 'tambahPesanan'])->name('tambahPesanan');
Route::post('/tambahPesanan', [PesananController::class, 'store'])->name('tambahPesanan.store');
    
Route::get('/statusPesanan',[PesananController::class,'statusPesanan'])->name('statusPesanan');
Route::patch('/pesanan/{id}/ubah-status', [PesananController::class, 'ubahStatusPesanan'])->name('ubahStatusPesanan');

Route::get('/keuangan', [PesananController::class, 'dataPemasukan'])->name('keuangan');
Route::get('/data-pemasukan', [KeuanganController::class, 'index'])->name('data.pemasukan');

Route::get('/lihatStatusPesanan', [PesananController::class, 'lihatStatusPesanan'])->name('lihatStatusPesanan');
Route::get('/pesanan/cari', [PesananController::class, 'cari'])->name('pesanan.cari');

