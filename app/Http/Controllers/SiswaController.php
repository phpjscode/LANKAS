<?php

namespace App\Http\Controllers;

use App\Models\Siswa;

class SiswaController extends Controller
{
    public function showSiswa()
    {
        return view('siswa', [
            'siswa' => Siswa::all(), // Langsung ambil data
            'title' => 'Siswa'
        ]);
    }
}
