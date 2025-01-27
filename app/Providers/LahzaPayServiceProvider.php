<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Classes\LahzaPay;
    
class LahzaPayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(LahzaPay::class, function ($app) {
            return new LahzaPay();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
