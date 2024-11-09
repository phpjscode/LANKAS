<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function showPengeluaran()
    {
        return view('pengeluaran', [
            'title' => 'Pengeluaran'
        ]);
    }

    public function storePengeluaran(Request $request)
    {
        // Validasi input
        $request->validate([
            'jumlah_pengeluaran' => 'required|numeric',
            'keterangan' => 'required|string',
        ]);

        // Simpan pengeluaran sesuai user yang sedang login
        Pengeluaran::create([
            'id_user' => Auth::id(), // Mendapatkan ID pengguna yang sedang login
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'keterangan' => $request->keterangan,
            'tanggal_pengeluaran' => now(), // Mengisi tanggal_pengeluaran dengan waktu saat ini
        ]);

        return response()->json(['success' => 'Pengeluaran berhasil ditambahkan']);
    }
}
