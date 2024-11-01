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
        $bulanPembayaran = $event->bulanPembayaran;
        $siswaList = Siswa::all();

        foreach ($siswaList as $siswa) {
            if (!UangKas::where('id_siswa', $siswa->id)->where('id_bulan_pembayaran', $bulanPembayaran->id)->exists()) {
                UangKas::create([
                    'id_siswa' => $siswa->id,
                    'id_bulan_pembayaran' => $bulanPembayaran->id,
                    'minggu_ke_1' => $bulanPembayaran->pembayaran_perminggu,
                    'minggu_ke_2' => $bulanPembayaran->pembayaran_perminggu,
                    'minggu_ke_3' => $bulanPembayaran->pembayaran_perminggu,
                    'minggu_ke_4' => $bulanPembayaran->pembayaran_perminggu,
                    'status_lunas' => 0
                ]);
            }
        }
    }
}
