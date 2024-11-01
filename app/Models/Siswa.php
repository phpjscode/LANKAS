<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Jika kamu ingin menentukan tabel yang digunakan
    protected $table = 'siswa';

    // Menentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama_siswa',
        'jenis_kelamin',
        'no_telepon',
    ];

    public function uangKas()
    {
        return $this->hasMany(UangKas::class, 'id_siswa');
    }

    protected static function booted()
    {
        // Event saat siswa baru dibuat
        static::created(function ($siswa) {

            $bulanPembayaranList = BulanPembayaran::all();

            foreach ($bulanPembayaranList as $bulan) {
                UangKas::create([
                    'id_siswa' => $siswa->id,
                    'id_bulan_pembayaran' => $bulan->id,
                    'minggu_ke_1' => 0,
                    'minggu_ke_2' => 0,
                    'minggu_ke_3' => 0,
                    'minggu_ke_4' => 0,
                    'status_lunas' => 0
                ]);
            }
        });
    }
}
