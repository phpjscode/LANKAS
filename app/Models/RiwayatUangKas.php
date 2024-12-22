<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatUangKas extends Model
{
    use HasFactory;

    protected $table = 'riwayat_uang_kas';

    protected $fillable = [
        'id_user',
        'id_uang_kas',
        'aksi',
        'tanggal',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke UangKas
    public function uangKas()
    {
        return $this->belongsTo(UangKas::class, 'id_uang_kas');
    }
}
