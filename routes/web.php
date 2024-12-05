<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});


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
