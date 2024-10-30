<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\SiswaSeeder;
use Database\Seeders\BulanPembayaranSeeder;
use Database\Seeders\UangKasSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(UserSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(BulanPembayaranSeeder::class);
        $this->call(UangKasSeeder::class);
    }
}
