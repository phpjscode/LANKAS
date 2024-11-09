<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function showPengeluaran()
    {
        $pengeluaran = Pengeluaran::with('user')->get();
        return view('pengeluaran', [
            'title' => 'Pengeluaran',
            'pengeluaran' => $pengeluaran
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

    public function updatePengeluaran(Request $request, $id)
    {
        $request->validate([
            'jumlah_pengeluaran' => 'required|numeric',
            'keterangan' => 'required|string|max:255',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->update([
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'keterangan' => $request->keterangan,
        ]);
        return response()->json(['message' => 'Data pengeluaran berhasil diperbarui.']);
    }


    public function destroyPengeluaran($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return response()->json(['message' => 'Pengeluaran berhasil dihapus.']);
    }
}
