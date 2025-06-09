<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Mengatasi masalah panjang string di MySQL (opsional)
        Schema::defaultStringLength(191);

        // Paksa HTTPS jika di environment production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Debug query untuk mengetahui query yang lambat
        if ($this->app->environment('local')) {
            DB::listen(function ($query) {
                Log::info('Query: ' . $query->sql, ['bindings' => $query->bindings, 'time' => $query->time]);
            });
        }
    }
}
