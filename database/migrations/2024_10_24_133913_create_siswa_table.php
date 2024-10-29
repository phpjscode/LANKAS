<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama_siswa', 100)->unique();;
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Pilihan jenis kelamin
            $table->string('no_telepon', 15)->unique(); // Nomor telepon unik
            $table->timestamps(); // Menyimpan waktu pembuatan & update
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
}
