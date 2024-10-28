<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        $credentials = $this->validateLogin($request);

        if ($this->attemptLogin($credentials, $request)) {
            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau Password salah']);
    }



    /**
     * Mencoba login pengguna.
     */
    protected function attemptLogin(array $credentials, Request $request): bool
    {
        $remember = $credentials['remember'] ?? false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // Mencegah sesi fixasi
            return true;
        }

        return false;
    }

    /**
     * Memproses logout dan mengakhiri sesi.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Mencegah CSRF

        return redirect('/login')->with('success', 'Anda telah logout.');
    }

    /**
     * Validasi input login.
     */
    protected function validateLogin(Request $request): array
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'boolean',
        ]);
    }
}
