<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika sudah login, kirimkan $title ke view
        return view('index', [
            'title' => 'Dashboard'  // Pastikan ini dikirim
        ]);
    }
}
