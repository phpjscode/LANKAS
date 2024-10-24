<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Kirim data ke view profil
        return view('profile', [
            'user' => $user, // Kirim data pengguna
            'title' => 'Profile'  // Pastikan ini dikirim
        ]);
    }
}
