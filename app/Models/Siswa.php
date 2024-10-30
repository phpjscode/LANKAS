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
}
