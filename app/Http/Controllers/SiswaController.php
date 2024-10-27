<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function showSiswa()
    {
        return view('siswa', [
            'title' => 'Siswa'
        ]);
    }
}
