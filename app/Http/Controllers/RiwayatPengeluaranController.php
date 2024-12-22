<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPengeluaran;

class RiwayatPengeluaranController extends Controller
{
    public function showRiwayatPengeluaran(Request $request)
    {
        $jumlah = $request->input('jumlah', 5);
        $riwayatPengeluaran = RiwayatPengeluaran::paginate($jumlah);

        if ($request->ajax()) {
            return view('components.table-riwayat-pengeluaran', compact('riwayatPengeluaran'))->render();
        }

        return view('riwayat-pengeluaran', [
            'title' => 'Riwayat Pengeluaran',
            'riwayatPengeluaran' => $riwayatPengeluaran
        ]);
    }

    public function filterRiwayatPengeluaran(Request $request)
    {
        $query = RiwayatPengeluaran::query();

        if ($request->has('search') && $request->search !== '') {
            $query->where('aksi', 'like', '%' . $request->search . '%')
                ->orWhere('tanggal', 'like', '%' . $request->search . '%');
        }

        $riwayatPengeluaran = $query->get();

        if ($request->ajax()) {
            return view('components.table-riwayat-pengeluaran', compact('riwayatPengeluaran'))->render();
        }

        return view('riwayat-pengeluaran', [
            'riwayatPengeluaran' => $riwayatPengeluaran,
            'title' => 'Riwayat Pengeluaran'
        ]);
    }
}
