<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->decimal('jumlah_pengeluaran', 15, 2); // Kolom untuk jumlah pengeluaran, dengan presisi
            $table->text('keterangan'); // Kolom untuk keterangan
            $table->date('tanggal_pengeluaran'); // Kolom untuk tanggal pengeluaran
            $table->foreignId('id_user') // Kolom untuk foreign key
                ->constrained('users') // Mengacu ke tabel users
                ->onDelete('cascade'); // Jika user dihapus, hapus juga data pengeluarannya
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};
