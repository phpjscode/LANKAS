<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel Users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 255)->unique()->index(); // Email indexed untuk pencarian cepat
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255); // Panjang password disesuaikan dengan hash
            $table->rememberToken();
            $table->timestamps();
        });

        // Tabel Sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID untuk keamanan
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete(); // Relasi ke users
            $table->string('ip_address', 45)->nullable(); // IPv4 & IPv6
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index(); // Index untuk aktivitas terakhir
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
