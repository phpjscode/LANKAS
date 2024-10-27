<?php

namespace App\Http\Controllers;

use App\Models\Siswa; // Pastikan model Siswa sudah diimport
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import facade Auth jika belum

class IndexController extends Controller
{
    public function showDashboard()
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika sudah login, kirimkan $title dan $totalSiswa ke view
        return view('index', [
            'title' => 'Dashboard',  // Judul halaman
            'totalSiswa' => Siswa::count(),  // Jumlah siswa yang dihitung
        ]);
    }
}
