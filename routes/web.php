<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UangKasController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\RiwayatPengeluaranController;
use App\Http\Controllers\DetailBulanPembayaranController;

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

  // Detail Bulan Pembayaran routes
  Route::post('/detail-bulan-pembayaran/{id}', [DetailBulanPembayaranController::class, 'showBulanPembayaran'])->name('detailbulanpembayaran');
  Route::get('/detail-bulan-pembayaran/{id}/filter', [DetailBulanPembayaranController::class, 'filterPembayaranSiswa'])->name('detailbulanpembayaran.filter');
  Route::post('/update-pembayaran-uang-kas-siswa', [DetailBulanPembayaranController::class, 'updatePembayaranUangKasSiswa'])->name('detailbulanpembayaran.update');

  // Pengeluaran routes
  Route::match(['GET', 'POST'], '/pengeluaran', [PengeluaranController::class, 'showPengeluaran'])->name('pengeluaran');
  Route::get('/pengeluaran/filter', [SiswaController::class, 'filterPengeluaran'])->name('pengeluaran.filter');
  Route::post('/pengeluaran', [PengeluaranController::class, 'storePengeluaran'])->name('pengeluaran.store');
  Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroyPengeluaran'])->name('pengeluaran.destroy');
  Route::patch('/pengeluaran/{id}', [PengeluaranController::class, 'updatePengeluaran'])->name('pengeluaran.update');

  Route::get('/riwayat-pengeluaran', [RiwayatPengeluaranController::class, 'showRiwayatPengeluaran'])->name('riwayatpengeluaran');
});
