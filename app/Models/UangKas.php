<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UangKas extends Model
{
    use HasFactory;

    protected $fillable = ['bulan_pembayaran_id', 'minggu_ke_1', 'minggu_ke_2', 'minggu_ke_3', 'minggu_ke_4'];

    public function bulanPembayaran()
    {
        return $this->belongsTo(BulanPembayaran::class, 'id_bulan_pembayaran');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
