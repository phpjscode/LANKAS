<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatUangKasController extends Controller
{
    public function showRiwayatUangKas()
    {
        return view('riwayat-uang-kas', [
            'title' => 'Riwayat Uang Kas',
        ]);
    }
}
