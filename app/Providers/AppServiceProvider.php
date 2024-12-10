<?php

namespace App\Providers;


use Filament\Forms\Form;
use Illuminate\Support\ServiceProvider;
use FilamentTiptapEditor\TiptapEditor;
use LaraZeus\Sky\Filament\Resources\TagResource;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //  $r = TagResource::form(app(Form::class));



    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app()->setLocale('ar');

        FilamentAsset::register([
            // Js::make('alpine-lazy-load-assets', 'https://unpkg.com/alpine-lazy-load-assets@latest/dist/alpine-lazy-load-assets.cdn.js'),
            Js::make('countdown-timer', asset('js/blocks/libs/countdown.min.js'))
            
        ]);

        TiptapEditor::configureUsing(function (TiptapEditor $tiptapEditor) {
            $tiptapEditor
                ->collapseBlocksPanel()

                ->blocks([
                    \App\TiptapBlocks\CountdownTimer::class,
                    \App\TiptapBlocks\PdfView::class
                ]);
        });
    }

}


