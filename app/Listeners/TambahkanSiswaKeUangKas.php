<?php

namespace App\Listeners;

use App\Events\SiswaDitambahkan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TambahkanSiswaKeUangKas
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
    public function handle(SiswaDitambahkan $event): void
    {
        $siswa = $event->siswa;
        $bulanPembayaranIds = BulanPembayaran::all()->pluck('id'); // dapatkan semua bulan yang berlaku

        foreach ($bulanPembayaranIds as $bulanId) {
            DB::table('uang_kas')->insert([
                'id_siswa' => $siswa->id,
                'id_bulan_pembayaran' => $bulanId,
                'minggu_ke_1' => 0,
                'minggu_ke_2' => 0,
                'minggu_ke_3' => 0,
                'minggu_ke_4' => 0,
                'status_lunas' => 0,
            ]);
        }
    }
}
