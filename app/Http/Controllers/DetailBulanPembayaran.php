<?php

namespace App\Http\Controllers;

use App\Models\BulanPembayaran;
use Illuminate\Http\Request;

class DetailBulanPembayaran extends Controller
{
    public function showBulanPembayaran($id)
    {
        $bulan = BulanPembayaran::with('uangKas.siswa')->findOrFail($id);
        $pembayaranPerminggu = $bulan->pembayaran_perminggu;

        return view('detail-bulan-pembayaran', [
            'title' => 'Detail Bulan Pembayaran',
            'bulan' => $bulan,
            'pembayaranPerminggu' => $pembayaranPerminggu,
        ]);
    }
}
