<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatPengeluaranController extends Controller
{
    public function showRiwayatPengeluaran(Request $request)
    {
        return view('riwayat-pengeluaran', [
            'title' => 'Pengeluaran',
        ]);
    }
}
