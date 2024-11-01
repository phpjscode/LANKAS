<?php

namespace App\Http\Controllers;

use App\Models\BulanPembayaran;
use Illuminate\Http\Request;

class DetailBulanPembayaran extends Controller
{
    public function showBulanPembayaran($id)
    {
        // Eager loading uangKas dan relasi siswa
        $bulan = BulanPembayaran::with('uangKas.siswa')->findOrFail($id);

        return view('detail-bulan-pembayaran', [
            'title' => 'Detail Bulan Pembayaran',
            'bulan' => $bulan,
            'pembayaranPerminggu' => $bulan->pembayaran_perminggu,
        ]);
    }
}
