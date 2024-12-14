<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Siswa;
use App\Models\BulanPembayaran;
use App\Models\Pengeluaran;
use App\Observers\SiswaObserver;
use App\Observers\BulanPembayaranObserver;
use App\Models\UangKas;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Mendaftarkan observer untuk Siswa dan BulanPembayaran
        Siswa::observe(SiswaObserver::class);
        BulanPembayaran::observe(BulanPembayaranObserver::class);

        $totalUangKotor = 0;
        $totalUangPengeluaran = 0;

        // Pastikan tabel UangKas dan Pengeluaran sudah ada sebelum mengakses
        if (Schema::hasTable('uang_kas') && Schema::hasTable('pengeluaran')) {
            // Hitung total nilai dari minggu_ke_1 hingga minggu_ke_4 untuk semua siswa
            $totalUangKotor = UangKas::sum('minggu_ke_1')
                + UangKas::sum('minggu_ke_2')
                + UangKas::sum('minggu_ke_3')
                + UangKas::sum('minggu_ke_4');

            $totalUangPengeluaran = Pengeluaran::sum('jumlah_pengeluaran');
        }

        $totalUangBersih = $totalUangKotor - $totalUangPengeluaran;

        // Bagikan variabel ke semua view
        View::share([
            'totalUangBersih' => $totalUangBersih,
            'totalUangPengeluaran' => $totalUangPengeluaran
        ]);
    }
}
