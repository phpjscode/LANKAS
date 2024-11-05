<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();

        // Kirim data ke view profil
        return view('profiles', [
            'user' => $user, // Kirim data pengguna
            'title' => 'Profil'  // Pastikan ini dikirim
        ]);
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
                Rule::unique('users')->ignore($user->id), // Pastikan menggunakan namespace yang benar
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
