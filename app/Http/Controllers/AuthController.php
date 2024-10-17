<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login'); // Pastikan ini merujuk ke file view yang sesuai
    }

    // Memproses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'boolean',
        ]);

        // Mengambil nilai 'remember' dari request
        $remember = $credentials['remember'] ?? false;

        // Cek kredensial
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ], $remember)) {
            // Login sukses, redirect ke halaman beranda
            return redirect('/')->with('success', 'Login berhasil!');
        }

        // Jika login gagal, kembali ke form dengan pesan error yang lebih umum
        return back()->withErrors(['email' => 'Email atau Password salah']);
    }
}
