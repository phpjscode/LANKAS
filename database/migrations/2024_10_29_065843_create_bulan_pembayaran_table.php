<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBulanPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulan_pembayaran', function (Blueprint $table) {
            $table->id(); // Primary key auto-increment
            $table->enum('nama_bulan', [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ]); // Enum untuk nama bulan
            $table->integer('tahun'); // Tahun pembayaran
            $table->integer('pembayaran_perminggu'); // Jumlah pembayaran per minggu
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bulan_pembayaran');
    }
}
