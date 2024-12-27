<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        return view('profile', [
            'user' => Auth::user(),
            'title' => 'Profil'
        ]);
    }

    /**
     * Memperbarui data profil pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        // Memvalidasi input dan mengupdate profil pengguna
        Auth::user()->update($request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::id()),
            ],
        ]));

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Memperbarui kata sandi pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Memvalidasi password
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        // Memeriksa apakah password lama benar
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama salah.']);
        }

        // Memperbarui password pengguna
        $user->update(['password' => Hash::make($request->new_password)]);

        Auth::logout();
        return redirect()->route('login')->with('status', 'Password berhasil diperbarui. Silakan login kembali.');
    }
}
