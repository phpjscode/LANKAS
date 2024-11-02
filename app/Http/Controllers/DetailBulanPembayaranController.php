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
        // Dapatkan id bulan pembayaran berdasarkan siswa
        $uangKas = UangKas::where('id_siswa', $request->id_siswa)
            ->where('id_bulan_pembayaran', $request->id_bulan_pembayaran)
            ->first();

        if (!$uangKas) {
            return response()->json(['success' => false, 'message' => 'Data uang kas tidak ditemukan'], 400);
        }

        // Dapatkan pembayaran per minggu dari tabel BulanPembayaran
        $bulanPembayaran = BulanPembayaran::where('id', $uangKas->id_bulan_pembayaran)->first();
        $pembayaranPerminggu = $bulanPembayaran->pembayaran_perminggu ?? 0;

        $request->validate([
            'id_siswa' => 'required|exists:uang_kas,id_siswa',
            'id_bulan_pembayaran' => 'required|exists:bulan_pembayaran,id', // Tambahkan ini
            'minggu_ke' => 'required|string|in:minggu_ke_1,minggu_ke_2,minggu_ke_3,minggu_ke_4',
            'nilai' => 'required|numeric|max:' . $pembayaranPerminggu,
        ]);

        // Logika disable minggu sebelumnya jika minggu setelahnya sudah penuh
        $mingguKeMap = [
            'minggu_ke_1' => 1,
            'minggu_ke_2' => 2,
            'minggu_ke_3' => 3,
            'minggu_ke_4' => 4,
        ];

        $currentMinggu = $mingguKeMap[$request->minggu_ke];

        // Cek apakah minggu setelah minggu yang dipilih sudah penuh
        for ($i = $currentMinggu + 1; $i <= 4; $i++) {
            $minggu = 'minggu_ke_' . $i;
            if ($uangKas->{$minggu} >= $pembayaranPerminggu) {
                return response()->json(['success' => false, 'message' => 'Tidak dapat mengubah minggu ini karena minggu berikutnya sudah penuh.'], 400);
            }
        }

        // Update nilai minggu yang diinginkan
        $uangKas->{$request->minggu_ke} = $request->nilai;
        $uangKas->save();

        // Cek jika semua minggu sudah memenuhi pembayaranPerminggu untuk mengubah status_lunas
        $allWeeksPaid = (
            $uangKas->minggu_ke_1 >= $pembayaranPerminggu &&
            $uangKas->minggu_ke_2 >= $pembayaranPerminggu &&
            $uangKas->minggu_ke_3 >= $pembayaranPerminggu &&
            $uangKas->minggu_ke_4 >= $pembayaranPerminggu
        );

        // Set status_lunas menjadi 1 jika semua minggu sudah terbayar
        $uangKas->status_lunas = $allWeeksPaid ? 1 : 0;
        $uangKas->save();

        return response()->json(['success' => true]);
    }
}
