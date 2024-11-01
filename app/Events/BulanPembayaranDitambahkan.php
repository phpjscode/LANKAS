<?php

namespace App\Events;

use App\Models\BulanPembayaran;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BulanPembayaranDitambahkan
{
    use Dispatchable, SerializesModels;

    public $bulanPembayaran;

    public function __construct(BulanPembayaran $bulanPembayaran)
    {
        $this->bulanPembayaran = $bulanPembayaran;
    }
}
