<?php

namespace App\Observers;

use App\Models\BulanPembayaran;
use App\Models\Siswa;
use App\Models\UangKas;

class BulanPembayaranObserver
{
    public function created(BulanPembayaran $bulanPembayaran)
    {

        // Mendapatkan daftar siswa
        $siswaList = Siswa::all();

        // Menambahkan entri uang kas baru untuk setiap siswa
        foreach ($siswaList as $siswa) {
            UangKas::create([
                'id_siswa' => $siswa->id,
                'id_bulan_pembayaran' => $bulanPembayaran->id,
                'minggu_ke_1' => $bulanPembayaran->pembayaran_perminggu,
                'minggu_ke_2' => $bulanPembayaran->pembayaran_perminggu,
                'minggu_ke_3' => $bulanPembayaran->pembayaran_perminggu,
                'minggu_ke_4' => $bulanPembayaran->pembayaran_perminggu,
                'status_lunas' => 0,
            ]);
        }
    }
}
