<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Set locale Carbon
        Carbon::setLocale('id');

        // Set locale PHP agar translatedFormat() tampil bahasa Indonesia
        setlocale(LC_TIME, 'id_ID.utf8', 'id_ID', 'Indonesian_indonesia.1252', 'id');

        // Force HTTPS untuk environment production atau staging
        if ($this->app->environment('production') || $this->app->environment('staging')) {
            //URL::forceScheme('https');
        }
    }
}
