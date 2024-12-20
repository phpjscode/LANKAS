<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPengeluaran;

class RiwayatPengeluaranController extends Controller
{
    public function showRiwayatPengeluaran(Request $request)
    {
        // Mengambil parameter jumlah dan search dari request
        $perPage = $request->get('jumlah', 5);  // Default ke 5 jika tidak ada parameter
        $search = $request->get('search', '');

        // Query untuk mengambil pengeluaran dengan relasi 'user' dan filter berdasarkan pencarian
        $riwayatPengeluaran = RiwayatPengeluaran::with('user')
            ->where('keterangan', 'like', "%$search%")  // Filter berdasarkan keterangan
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");  // Filter berdasarkan nama pengguna
            })
            ->paginate($perPage);  // Pagination berdasarkan jumlah yang dipilih

        return view('riwayat-pengeluaran', [
            'title' => 'Riwayat Pengeluaran',
            'riwayatPengeluaran' => $riwayatPengeluaran
        ]);
    }
}
