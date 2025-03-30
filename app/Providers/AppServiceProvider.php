<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        if (Schema::hasTable('configs')) {
            // Load the config data from the cache or database
            $configData = Cache::rememberForever('configData', function () {
                return Config::first();
            });

            // Share the config data with all views
            View::share('configData', $configData);
        }
    }
}
