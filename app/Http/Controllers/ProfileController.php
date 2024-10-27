<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {

        // Kirim data ke view profil
        return view('profile', [
            'user' => $user = Auth::user(), // Kirim data pengguna
            'title' => 'Profil'  // Pastikan ini dikirim
        ]);
    }
}
