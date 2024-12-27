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
        $siswa = Siswa::count();

        return view('index', [
            'title' => 'Dashboard',
            'siswa' => $siswa,
        ]);
    }
}
