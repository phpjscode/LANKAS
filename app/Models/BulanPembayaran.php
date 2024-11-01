<?php

namespace App\Models;

use App\Models\UangKas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BulanPembayaran extends Model
{
    use HasFactory;

    protected $table = 'bulan_pembayaran';
    protected $fillable = ['nama_bulan', 'tahun', 'pembayaran_perminggu'];

    public function uangKas()
    {
        return $this->hasMany(UangKas::class, 'id_bulan_pembayaran');
    }
}
