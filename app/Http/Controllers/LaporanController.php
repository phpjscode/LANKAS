<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\UangKas;
use App\Models\Pengeluaran;
use App\Models\BulanPembayaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function showLaporan()
    {
        $bulanPembayaran = BulanPembayaran::all();

        return view('laporan', [
            'title' => 'Laporan',
            'bulanPembayaran' => $bulanPembayaran,
        ]);
    }

    public function printLaporan(Request $request)
    {
        $request->validate([
            'bulan' => 'required|exists:bulan_pembayaran,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $bulan = BulanPembayaran::findOrFail($request->bulan);
        $pemasukan = UangKas::where('id_bulan_pembayaran', $bulan->id)
            ->with('siswa')
            ->get();

        $pengeluaran = Pengeluaran::when($request->start_date, function ($query) use ($request) {
            return $query->where('tanggal_pengeluaran', '>=', $request->start_date);
        })
            ->when($request->end_date, function ($query) use ($request) {
                return $query->where('tanggal_pengeluaran', '<=', $request->end_date);
            })
            ->get();

        $pdf = Pdf::loadView('laporan.pdf', [
            'bulan' => $bulan,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
        ]);

        return $pdf->download('laporan_bulanan.pdf');
    }
}
