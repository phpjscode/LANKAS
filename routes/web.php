<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;

Route::get('/', [IndexController::class, 'showDashboard'])->name('index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
Route::middleware('auth')->post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile/update-password', [AuthController::class, 'updatePassword'])->name('profile.update-password');

Route::get('/siswa', [SiswaController::class, 'showSiswa'])->name('siswa');
