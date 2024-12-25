<?php

namespace App\Http\Controllers;

use App\Models\RiwayatUangKas;
use Illuminate\Http\Request;

class RiwayatUangKasController extends Controller
{
    public function showRiwayatUangKas(Request $request)
    {
        // Ambil semua data riwayat dengan relasi user dan uangKas
        $jumlah = $request->input('jumlah', 5);
        $riwayatUangKas = RiwayatUangKas::paginate($jumlah);

        if ($request->ajax()) {
            return view('components.table-riwayat-uang-kas', compact('riwayatUangKas'))->render();
        }

        return view('riwayat-uang-kas', [
            'title' => 'Riwayat Uang Kas',
            'riwayatUangKas' => $riwayatUangKas,
        ]);
    }

    public function filterRiwayatUangKas(Request $request)
    {
        $query = RiwayatUangKas::query();

        if ($request->has('search') && $request->search !== '') {
            $query->where('aksi', 'like', '%' . $request->search . '%')
                ->orWhere('tanggal', 'like', '%' . $request->search . '%');
        }

        $riwayatUangKas = $query->get();

        if ($request->ajax()) {
            return view('components.table-riwayat-uang-kas', compact('riwayatUangKas'))->render();
        }

        return view('riwayat-pengeluaran', [
            'title' => 'Riwayat Pengeluaran',
            'riwayatUangKas' => $riwayatUangKas
        ]);
    }
}
