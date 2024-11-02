<?php

namespace App\Http\Controllers;

use App\Models\BulanPembayaran;
use App\Models\UangKas;
use Illuminate\Http\Request;

class DetailBulanPembayaranController extends Controller
{
    public function showBulanPembayaran($id)
    {
        $bulan = BulanPembayaran::with('uangKas.siswa')->findOrFail($id);
        $pembayaranPerminggu = $bulan->pembayaran_perminggu;

        $title = "Detail Bulan Pembayaran : " . $bulan->nama_bulan . ' ' . $bulan->tahun;

        return view('detail-bulan-pembayaran', [
            'title' => $title,
            'bulan' => $bulan,
            'pembayaranPerminggu' => $pembayaranPerminggu,
        ]);
    }

    public function updatePembayaranUangKasSiswa(Request $request)
    {
        // Dapatkan id bulan pembayaran berdasarkan siswa, sesuaikan logikanya jika perlu
        $uangKas = UangKas::where('id_siswa', $request->id_siswa)->first();

        if (!$uangKas) {
            return response()->json(['success' => false, 'message' => 'Data uang kas tidak ditemukan'], 400);
        }

        $bulanPembayaran = BulanPembayaran::where('id', $uangKas->id_bulan_pembayaran)->first();
        $pembayaranPerminggu = $bulanPembayaran->pembayaran_perminggu ?? 0;

        $request->validate([
            'id_siswa' => 'required|exists:uang_kas,id_siswa',
            'minggu_ke' => 'required|string|in:minggu_ke_1,minggu_ke_2,minggu_ke_3,minggu_ke_4',
            'nilai' => 'required|numeric|max:' . $pembayaranPerminggu,
        ]);

        if (in_array($request->minggu_ke, ['minggu_ke_1', 'minggu_ke_2', 'minggu_ke_3', 'minggu_ke_4'])) {
            $uangKas->{$request->minggu_ke} = $request->nilai;
            $uangKas->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
