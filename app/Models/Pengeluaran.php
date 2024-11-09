<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    protected $fillable = [
        'id_user',
        'jumlah_pengeluaran',
        'keterangan',
        'tanggal_pengeluaran',
    ];
}
