<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('login', ['title' => 'Login']);
    }

    public function login(Request $request)
    {
        $credentials = $this->validateLogin($request);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $credentials['remember'] ?? false)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau Password salah']);
    }

    protected function validateLogin(Request $request): array
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'boolean',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
