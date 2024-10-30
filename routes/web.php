<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UangKasController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
  // Profile routes
  Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
  Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
  Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

  // Dashboard routes
  Route::get('/', [IndexController::class, 'showDashboard'])->name('index');

  // Siswa routes
  Route::get('/siswa', [SiswaController::class, 'showSiswa'])->name('siswa');
  Route::post('/siswa', [SiswaController::class, 'storeSiswa'])->name('siswa.store');
  Route::patch('/siswa/{id}', [SiswaController::class, 'updateSiswa'])->name('siswa.update');
  Route::delete('/siswa/{id}', [SiswaController::class, 'destroySiswa'])->name('siswa.destroy');
  Route::get('/siswa/filter', [SiswaController::class, 'filterSiswa'])->name('siswa.filter');

  // Uang Kas routes
  Route::get('/uangkas', [UangKasController::class, 'showUangKas'])->name('uangkas');
  Route::post('/uangkas', [UangKasController::class, 'storeBulanPembayaran'])->name('uangkas.store');
  Route::delete('/uangkas/{id}', [UangKasController::class, 'destroyBulanPembayaran'])->name('uangkas.destroy');
  Route::post('/detail-bulan-pembayaran/{id}', [UangKasController::class, 'detailBulanPembayaran'])->name('uangkas.detail');
});
