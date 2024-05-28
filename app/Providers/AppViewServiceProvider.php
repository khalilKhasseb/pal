<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\View\View;
use App\View\Creators\AppLayoutCreator;
use App\View\Creators\BlogCreator;
use App\View\Creators\HeaderSettingsCreator;

class AppViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        Facades\View::composer('*', AppLayoutCreator::class);
        Facades\View::composer('theme.partial.header', HeaderSettingsCreator::class);
        // Facades\View::composer('layouts.app', HeaderSettingsCreator::class);
        // Facades\View::composer('theme.partial.header', HeaderSettingsCreator::class);
        Facades\View::composer('zeus::themes.zeus.sky.partial.sidebar', BlogCreator::class);
    }
}
