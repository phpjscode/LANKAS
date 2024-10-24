<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('siswa')->insert([
            [
                'nama_siswa' => 'Ahmad Zaki',
                'jenis_kelamin' => 'Laki-laki',
                'no_telepon' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_siswa' => 'Siti Nurhaliza',
                'jenis_kelamin' => 'Perempuan',
                'no_telepon' => '081298765432',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_siswa' => 'Budi Santoso',
                'jenis_kelamin' => 'Laki-laki',
                'no_telepon' => '081345678901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
