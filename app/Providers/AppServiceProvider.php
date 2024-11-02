<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Siswa;
use App\Models\BulanPembayaran;
use App\Observers\SiswaObserver;
use App\Observers\BulanPembayaranObserver;
use App\Models\UangKas;
use Illuminate\Support\Facades\View;

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

        // Hitung total nilai dari minggu_ke_1 hingga minggu_ke_4 untuk semua siswa
        $totalUang = UangKas::sum('minggu_ke_1')
            + UangKas::sum('minggu_ke_2')
            + UangKas::sum('minggu_ke_3')
            + UangKas::sum('minggu_ke_4');

        // Bagikan variabel ke semua view
        View::share('totalUang', $totalUang);
    }
}
