<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatUangKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_uang_kas', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('id_user'); // Foreign key ke tabel users
            $table->unsignedBigInteger('id_uang_kas'); // Foreign key ke tabel uang_kas
            $table->string('aksi'); // Deskripsi aksi yang dilakukan
            $table->timestamp('tanggal')->default(DB::raw('CURRENT_TIMESTAMP')); // Tanggal aksi
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_uang_kas')->references('id')->on('uang_kas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_uang_kas');
    }
}
