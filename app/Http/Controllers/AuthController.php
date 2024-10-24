<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


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

    public function updateProfile(Request $request)
    {
        $user = Auth::user();  // Ambil user terautentikasi

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        // Perbarui data user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();  // Simpan perubahan

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        $user = Auth::user();

        // Cek apakah password lama cocok
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }

        // Update password baru
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Logout dan redirect ke halaman login
        Auth::logout();

        return redirect()->route('login')->with('status', 'Password updated successfully. Please log in again.');
    }
}
