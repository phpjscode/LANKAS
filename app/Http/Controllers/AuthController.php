<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('login', ['title' => 'Login']);
    }

    /**
     * Memproses login.
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $this->validateLogin($request);

        // Cek kredensial dan login
        if ($this->attemptLogin($credentials, $request)) {
            return redirect('/')->with('success', 'Login berhasil!');
        }

        // Jika login gagal, kembali dengan pesan error
        return back()->withErrors(['email' => 'Email atau Password salah']);
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        $this->performLogout($request);

        return redirect('/login')->with('success', 'Anda telah logout.');
    }

    /**
     * Validasi input login.
     */
    protected function validateLogin(Request $request)
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'boolean',
        ]);
    }

    /**
     * Cek kredensial dan login.
     */
    protected function attemptLogin(array $credentials, Request $request): bool
    {
        $remember = $credentials['remember'] ?? false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // Regenerasi sesi untuk mencegah sesi fixasi
            return true; // Login sukses
        }

        return false; // Login gagal
    }

    /**
     * Logout pengguna dan invalidate sesi.
     */
    protected function performLogout(Request $request): void
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Mencegah CSRF
    }
}
