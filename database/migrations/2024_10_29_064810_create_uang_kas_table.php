<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUangKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uang_kas', function (Blueprint $table) {
            $table->id(); // Primary key dengan auto-increment
            $table->unsignedBigInteger('id_siswa'); // Foreign key ke tabel siswa
            $table->unsignedBigInteger('id_bulan_pembayaran'); // Foreign key ke tabel bulan_pembayaran
            $table->integer('minggu_ke_1')->nullable();
            $table->integer('minggu_ke_2')->nullable();
            $table->integer('minggu_ke_3')->nullable();
            $table->integer('minggu_ke_4')->nullable();
            $table->integer('status_lunas');

            // Menambahkan foreign key constraints
            $table->foreign('id_siswa')
                ->references('id')
                ->on('siswa')
                ->onDelete('cascade'); // Menghapus data uang_kas jika siswa dihapus

            $table->foreign('id_bulan_pembayaran')
                ->references('id')
                ->on('bulan_pembayaran')
                ->onDelete('cascade'); // Menghapus data uang_kas jika bulan pembayaran dihapus
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uang_kas');
    }
}
