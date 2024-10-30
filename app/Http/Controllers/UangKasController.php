<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UangKasController extends Controller
{
    public function showUangKas()
    {
        // Jika sudah login, kirimkan $title dan $totalSiswa ke view
        return view('uangkas', [
            'title' => 'Uang Kas',  // Judul halaman
        ]);
    }
}
