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
            $table->string('nama_bulan');
            $table->integer('tahun'); // Jika ingin menyimpan tahun sebagai integer
            $table->decimal('pembayaran_perminggu', 10, 2); // Untuk jumlah pembayaran
            $table->timestamps();
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
