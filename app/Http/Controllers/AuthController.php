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
     * Memperbarui profil pengguna.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $this->validateProfile($request, $user);

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Memperbarui password pengguna.
     */
    public function updatePassword(Request $request)
    {
        $this->validatePassword($request);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama salah.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        Auth::logout();
        return redirect()->route('login')->with('status', 'Password berhasil diperbarui. Silakan login kembali.');
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
     * Validasi data profil pengguna.
     */
    protected function validateProfile(Request $request, User $user): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);
    }

    /**
     * Validasi input perubahan password.
     */
    protected function validatePassword(Request $request): void
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
        ]);
    }
}
