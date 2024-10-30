<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BulanPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bulan_pembayaran')->insert([
            'nama_bulan' => 'Oktober',
            'tahun' => 2024,
            'pembayaran_perminggu' => 2000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
