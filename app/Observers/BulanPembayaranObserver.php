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
                'minggu_ke_1' => 0,
                'minggu_ke_2' => 0,
                'minggu_ke_3' => 0,
                'minggu_ke_4' => 0,
                'status_lunas' => 0,
            ]);
        }
    }
}
