<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPengeluaran extends Model
{
    // Tentukan nama tabel (opsional, jika tabel mengikuti penamaan Laravel, bisa diabaikan)
    protected $table = 'riwayat_pengeluaran';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_user',
        'aksi',
        'tanggal'
    ];

    // Nonaktifkan timestamps jika tidak menggunakan kolom created_at dan updated_at
    public $timestamps = false;

    // Relasi: RiwayatPengeluaran belongsTo User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
