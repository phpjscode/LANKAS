<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UangKas extends Model
{
    use HasFactory;

    protected $table = 'uang_kas';

    protected $fillable = [
        'id_siswa',
        'id_bulan_pembayaran',
        'minggu_ke_1',
        'minggu_ke_2',
        'minggu_ke_3',
        'minggu_ke_4',
        'status_lunas'
    ];

    public function bulanPembayaran()
    {
        return $this->belongsTo(BulanPembayaran::class, 'id_bulan_pembayaran');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
