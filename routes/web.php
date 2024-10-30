<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UangKasController;

Route::get('/', [IndexController::class, 'showDashboard'])->name('index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
Route::middleware('auth')->post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

Route::get('/siswa', [SiswaController::class, 'showSiswa'])->name('siswa');
Route::patch('/siswa/{id}', [SiswaController::class, 'updateSiswa'])->name('siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroySiswa'])->name('siswa.destroy');
Route::post('/siswa', [SiswaController::class, 'storeSiswa'])->name('siswa.store');
Route::get('/siswa/filter', [SiswaController::class, 'filterSiswa'])->name('siswa.filter');


Route::get('/uangkas', [UangKasController::class, 'showUangKas'])->name('uangkas');
Route::post('/uang_kas', [UangKasController::class, 'storeBulanPembayaran'])->name('uangkas.store');
