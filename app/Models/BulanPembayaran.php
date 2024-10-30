<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulanPembayaran extends Model
{
    use HasFactory;

    protected $table = 'bulan_pembayaran';
    protected $fillable = ['nama_bulan', 'tahun', 'pembayaran_perminggu'];

    public function uangKas()
    {
        return $this->hasMany(UangKas::class, 'bulan_pembayaran_id');
    }
}
