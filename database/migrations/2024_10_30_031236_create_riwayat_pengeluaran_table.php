<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPengeluaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pengeluaran', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('id_user'); // Foreign Key ke tabel users
            $table->text('aksi'); // Deskripsi riwayat
            $table->timestamp('tanggal')->useCurrent(); // Waktu aksi
            $table->timestamps(); // Tambahan created_at dan updated_at

            // Relasi dengan tabel users
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pengeluaran');
    }
}
