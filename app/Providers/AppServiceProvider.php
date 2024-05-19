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
                    return SkyPlugin::get()->getModel('Tag')::getWithType('category')->pluck('name', 'id');
                })
        ], 'category');

        SkyPlugin::get()->itemType(__('Collection'), [
            Select::make('collection')
                ->searchable()
                ->options(function () {
                    return [
                        'event' =>__('Events') ,
                        'activity' => __('Activities') ,
                        'administration' => __('Administrations'),
                        'hall' => __('Halls') ,
                        'partners'  => __('Partners'),
                        'product' => __('Products'),
                        'service'  => __('Services'),
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


// 'events' => [
//                             'class' => \App\Models\Post::class,
//                             'query' => 'event'
//                         ],
//                         'activities' => [
//                             'class' => \App\Models\Post::class,
//                             'query' => 'activity'
//                         ],
//                         'adminstration' => [
//                             'class' => \App\Models\Post::class,
//                             'query' => 'adminstration',
//                         ],
//                         'hall' => [
//                             'class' => \App\Models\Post::class,
//                             'query' => 'hall',
//                         ],
//                         'partners' => [
//                             'class' => \App\Models\Post::class,
//                             'query' => 'partners'
//                         ],
//                         'product' => [
//                             'class' => \App\Models\Post::class,
//                             'query' => 'product'
//                         ],
//                         'service' => [
//                             'class' => \App\Models\Post::class,
//                             'query' => 'service'
//                         ],
//                         'supporters' => [
//                             'class' => \App\Models\Supporter::class,
//                             'query' => 'all'
//                         ],
//                         'cource' => [
//                             'class' => \App\Models\Cource::class,
//                             'query' => 'all'
//                         ],
//                         'initiative' => [
//                             'class' => \App\Models\Initiative::class,
//                             'query' => 'all'
//                         ]