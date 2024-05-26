<?php

namespace App\Providers;

// use Filament\Facades\Filament;
// use Filament\Navigation\NavigationGroup;

use Illuminate\Support\ServiceProvider;
// use LaraZeus\Sky\Filament\Resources\PageResource;
use LaraZeus\Sky\SkyPlugin;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use App\Classes\GoogleFormsApi;
use App\Classes\GoogleAuthnticate;
use Google\Service\Drive;
use Google\Service\Forms;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app()->setLocale('ar');

        SkyPlugin::get()->itemType(__('Catoery'), [
            Select::make('category_id')
                ->searchable()
                ->options(function () {
                    return SkyPlugin::get()->getModel('Tag')::whereIn('type' ,SkyPlugin::get()->getModel('Tag')::getTypes())->pluck('name', 'id');
                })
        ], 'category');

        SkyPlugin::get()->itemType(__('Sommod Routes'), [
            Select::make('sommod_routes')
                ->label(__('Sommod Routes'))
                ->options([
                    'front.sommod.home' => ('Sommod Home'),
                ])
        ]);

        SkyPlugin::get()->itemType(__('Collection'), [
            Select::make('collection')
                ->searchable()
                ->options(function () {
                    return [
                        'event' => __('Events'),
                        'activity' => __('Activities'),
                        'administration' => __('Administrations'),
                        'hall' => __('Halls'),
                        'partners' => __('Partners'),
                        'product' => __('Products'),
                        'service' => __('Services'),
                        'supporters' => __('Supporters'),
                        'cource' => __('Cources'),
                        'initiative' => __('Initiatives'),
                        'blogs' => __('All News'),
                        'dashboard' => __('Library')
                    ];
                })
        ], 'collection');
    }
}


