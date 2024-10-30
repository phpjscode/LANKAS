<?php

namespace App\Http\Controllers;

use App\Models\BulanPembayaran;
use Illuminate\Http\Request;

class UangKasController extends Controller
{
    public function showUangKas()
    {
        $bulanPembayaran = BulanPembayaran::with('uangKas')
            ->orderBy('tahun', 'asc')
            ->get();

        // Mengirimkan data dalam bentuk array
        return view('uangkas', [
            'title' => 'Uang Kas',
            'bulanPembayaran' => $bulanPembayaran,
        ]);
    }

    public function storeBulanPembayaran(Request $request)
    {
        // Validasi data yang dikirim
        $validated = $request->validate([
            'nama_bulan' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'jumlah' => 'required|numeric',
        ]);

        // Simpan data ke database
        BulanPembayaran::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('uangkas')
            ->with('success', 'Bulan pembayaran berhasil ditambahkan!');
    }
}
