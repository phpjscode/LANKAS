<?php

namespace App\Http\Controllers;

use App\Models\Siswa;

class IndexController extends Controller
{
    /**
     * Tampilkan halaman dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function showDashboard()
    {
        // Menghitung jumlah siswa
        $siswa = Siswa::count();

        // Mengembalikan view dengan data yang diperlukan
        return view('index', [
            'title' => 'Dashboard', // Judul halaman
            'siswa' => $siswa,      // Jumlah siswa
        ]);
    }
}
