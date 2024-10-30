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
            $table->bigIncrements('id'); // Primary Key, Auto Increment
            $table->unsignedBigInteger('id_user'); // Foreign Key to users table
            $table->text('aksi'); // Action Description
            $table->integer('tanggal')->length(10); // Date stored as integer (timestamp)

            // Define foreign key constraint
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
