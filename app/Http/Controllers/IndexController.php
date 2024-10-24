<?php

namespace App\Http\Controllers;

use App\Models\Siswa; // Pastikan model Siswa sudah diimport
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import facade Auth jika belum

class IndexController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Menghitung jumlah siswa
        $totalSiswa = Siswa::count();

        // Jika sudah login, kirimkan $title dan $totalSiswa ke view
        return view('index', [
            'title' => 'Dashboard',  // Judul halaman
            'totalSiswa' => $totalSiswa,  // Jumlah siswa yang dihitung
        ]);
    }
}
