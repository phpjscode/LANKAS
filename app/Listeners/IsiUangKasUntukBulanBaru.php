<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\BulanPembayaranDitambahkan;
use App\Models\Siswa;
use App\Models\UangKas;

class IsiUangKasUntukBulanBaru
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BulanPembayaranDitambahkan $event)
    {
        // Ambil semua siswa
        $siswaList = Siswa::all();

        foreach ($siswaList as $siswa) {
            UangKas::create([
                'id_siswa' => $siswa->id,
                'id_bulan_pembayaran' => $event->bulanPembayaran->id, // Pastikan ini ada di event
                'minggu_ke_1' => $event->bulanPembayaran->pembayaran_perminggu,
                'minggu_ke_2' => $event->bulanPembayaran->pembayaran_perminggu,
                'minggu_ke_3' => $event->bulanPembayaran->pembayaran_perminggu,
                'minggu_ke_4' => $event->bulanPembayaran->pembayaran_perminggu,
                'status_lunas' => 0, // Atau sesuaikan sesuai kebutuhan
            ]);
        }
    }
}
