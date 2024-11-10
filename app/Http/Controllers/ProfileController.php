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
        return view('profile', [
            'user' => Auth::user(),
            'title' => 'Profil'
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $user->update($this->validateProfile($request, $user));

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

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

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $this->validatePassword($request);

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama salah.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        Auth::logout();
        return redirect()->route('login')->with('status', 'Password berhasil diperbarui. Silakan login kembali.');
    }

    protected function validatePassword(Request $request): void
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
        ]);
    }
}
