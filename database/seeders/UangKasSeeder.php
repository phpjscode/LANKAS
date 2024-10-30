<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UangKasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('uang_kas')->insert([
            [
                'id_siswa' => 1,
                'id_bulan_pembayaran' => 1,
                'minggu_ke_1' => 5000,
                'minggu_ke_2' => 5000,
                'minggu_ke_3' => 5000,
                'minggu_ke_4' => 5000,
                'status_lunas' => 1,
            ],
            [
                'id_siswa' => 2,
                'id_bulan_pembayaran' => 1,
                'minggu_ke_1' => 5000,
                'minggu_ke_2' => 5000,
                'minggu_ke_3' => 5000,
                'minggu_ke_4' => 5000,
                'status_lunas' => 1,
            ],
            [
                'id_siswa' => 3,
                'id_bulan_pembayaran' => 1,
                'minggu_ke_1' => 5000,
                'minggu_ke_2' => 5000,
                'minggu_ke_3' => 5000,
                'minggu_ke_4' => 5000,
                'status_lunas' => 1,
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ]);
    }
}
