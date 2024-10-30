<?php

namespace App\Http\Controllers;

use App\Models\BulanPembayaran;
use Illuminate\Http\Request;

class UangKasController extends Controller
{
    public function showUangKas()
    {
        // Mengirimkan data dalam bentuk array
        $bulanPembayaran = BulanPembayaran::all();

        return view('uangkas', [
            'title' => 'Uang Kas',
            'bulanPembayaran' => $bulanPembayaran
        ]);
    }

    public function storeBulanPembayaran(Request $request)
    {
        $validated = $request->validate([
            'nama_bulan' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'pembayaran_perminggu' => 'required|numeric',
        ]);

        BulanPembayaran::create($validated);

        return response()->json(['success' => 'Bulan pembayaran berhasil ditambahkan!']);
    }

    public function destroyBulanPembayaran($id)
    {
        $bulan = BulanPembayaran::findOrFail($id); // Cari data berdasarkan ID
        $bulan->delete(); // Hapus data

        return response()->json(['success' => 'Bulan pembayaran berhasil dihapus!']);
    }

    public function detailBulanPembayaran($id)
    {
        $bulan = BulanPembayaran::findOrFail($id);
        return view('detail-bulan-pembayaran', [
            'title' => 'Detail Bulan Pembayaran',
            'bulan' => $bulan
        ]);
    }
}
