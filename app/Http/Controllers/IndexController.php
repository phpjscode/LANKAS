<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // Method untuk menampilkan halaman index
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            // Jika belum login, redirect ke halaman login
            return redirect()->route('login');
        }

        // Jika sudah login, tampilkan halaman index
        return view('index');
    }
}
