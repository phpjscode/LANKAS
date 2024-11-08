<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function showPengeluaran()
    {
        return view('pengeluaran', [
            'title' => 'Pengeluaran'
        ]);
    }
}
