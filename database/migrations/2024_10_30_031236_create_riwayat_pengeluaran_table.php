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
            $table->id(); // Primary Key, Auto Increment
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // Foreign Key to users table
            $table->text('aksi'); // Action Description
            $table->timestamp('tanggal')->useCurrent(); // Date stored as timestamp with current default

            $table->timestamps(); // Created_at and Updated_at columns
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
