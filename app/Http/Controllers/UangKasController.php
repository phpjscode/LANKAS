<?php

namespace App\Http\Controllers;

use App\Events\BulanPembayaranDitambahkan;
use App\Models\BulanPembayaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'nama_bulan' => [
                'required',
                'string',
                'max:255',
                Rule::unique('bulan_pembayaran')->where(function ($query) use ($request) {
                    return $query->where('tahun', $request->tahun);
                })
            ],
            'tahun' => 'required|integer',
            'pembayaran_perminggu' => 'required|numeric',
        ]);

        // Jika validasi lolos, lanjutkan menyimpan data
        $bulanPembayaran = BulanPembayaran::create($validated);

        // Mengirimkan event
        event(new BulanPembayaranDitambahkan($bulanPembayaran));

        return response()->json(['success' => 'Bulan pembayaran berhasil ditambahkan!']);
    }

    public function destroyBulanPembayaran($id)
    {
        $bulan = BulanPembayaran::findOrFail($id); // Cari data berdasarkan ID
        $bulan->delete(); // Hapus data

        return response()->json(['success' => 'Bulan pembayaran berhasil dihapus!']);
    }
}
