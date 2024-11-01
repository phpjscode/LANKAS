<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Siswa;
use App\Models\BulanPembayaran;
use App\Observers\SiswaObserver;
use App\Observers\BulanPembayaranObserver;

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
    }
}
