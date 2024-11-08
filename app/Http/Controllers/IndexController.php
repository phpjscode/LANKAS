<?php

namespace App\Http\Controllers;

use App\Models\Siswa; // Pastikan model Siswa sudah diimport
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import facade Auth jika belum

class IndexController extends Controller
{
    public function showDashboard()
    {
        $siswa = Siswa::count(); // Mengambil semua data siswa

        return view('index', [
            'title' => 'Dashboard',
            'siswa' => $siswa, // Mengirim variabel siswa ke view
        ]);
    }
}
