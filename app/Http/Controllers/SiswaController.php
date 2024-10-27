<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function showSiswa()
    {
        return view('siswa', [
            'siswa' => Siswa::all(),
            'title' => 'Siswa'
        ]);
    }
}
