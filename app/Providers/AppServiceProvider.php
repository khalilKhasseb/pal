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
        $this->app->singletonIf(GoogleFormsApi::class, function () {
            return new GoogleFormsApi(GoogleAuthnticate::makeClient([
              Drive::DRIVE_READONLY,
              Forms::FORMS_BODY_READONLY,
              Forms::FORMS_RESPONSES_READONLY
            ]));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // app()->setLocale('ar');صي

        SkyPlugin::get()->itemType(__('Catoery'), [
            Select::make('category_id')
                ->searchable()
                ->options(function () {
                    return SkyPlugin::get()->getModel('Tag')::getWithType('category')->pluck('name', 'id');
                })
        ], 'category');
    }
}
