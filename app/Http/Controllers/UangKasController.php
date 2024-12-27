<?php

namespace App\Http\Controllers;

use App\Events\BulanPembayaranDitambahkan;
use App\Models\BulanPembayaran;
use App\Models\UangKas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UangKasController extends Controller
{
    public function showUangKas()
    {
        $bulanPembayaran = BulanPembayaran::all();

        foreach ($bulanPembayaran as $bulan) {
            $totalUang = UangKas::where('id_bulan_pembayaran', $bulan->id)
                ->selectRaw('SUM(minggu_ke_1 + minggu_ke_2 + minggu_ke_3 + minggu_ke_4) as total')
                ->value('total');

            $bulan->total_uang_kas = $totalUang;
        }

        return view('uangkas', [
            'title' => 'Uang Kas',
            'bulanPembayaran' => $bulanPembayaran,
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

        $bulanPembayaran = BulanPembayaran::create($validated);
        event(new BulanPembayaranDitambahkan($bulanPembayaran));

        return response()->json(['success' => 'Bulan pembayaran berhasil ditambahkan!']);
    }

    public function destroyBulanPembayaran($id)
    {
        $bulan = BulanPembayaran::findOrFail($id);
        $bulan->delete();

        return response()->json(['success' => 'Bulan pembayaran berhasil dihapus!']);
    }
}
