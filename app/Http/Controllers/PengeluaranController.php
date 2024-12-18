<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\RiwayatPengeluaran;
use Illuminate\Http\Request;
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

        try {
            // Simpan pengeluaran sesuai user yang sedang login
            $pengeluaran = Pengeluaran::create([
                'id_user' => Auth::id(), // Mendapatkan ID pengguna yang sedang login
                'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
                'keterangan' => $request->keterangan,
                'tanggal_pengeluaran' => now(), // Mengisi tanggal_pengeluaran dengan waktu saat ini
            ]);

            // Simpan riwayat ke tabel 'riwayat_pengeluaran'
            RiwayatPengeluaran::create([
                'id_user' => Auth::id(), // ID pengguna yang sama
                'aksi' => Auth::user()->name . " menambahkan pengeluaran: {$request->keterangan} sebesar Rp. " . number_format($request->jumlah_pengeluaran),
                'tanggal' => now(), // Waktu saat ini
            ]);

            return response()->json(['success' => 'Pengeluaran dan riwayat berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
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
