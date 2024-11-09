<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function showPengeluaran(Request $request)
    {
        // Mengambil parameter jumlah dan search dari request
        $perPage = $request->get('jumlah', 5);  // Default ke 5 jika tidak ada parameter
        $search = $request->get('search', '');

        // Query untuk mengambil pengeluaran dengan relasi 'user' dan filter berdasarkan pencarian
        $pengeluaran = Pengeluaran::with('user')
            ->where('keterangan', 'like', "%$search%")  // Filter berdasarkan keterangan
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");  // Filter berdasarkan nama pengguna
            })
            ->paginate($perPage);  // Pagination berdasarkan jumlah yang dipilih

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
