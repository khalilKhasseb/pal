<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use FilamentTiptapEditor\TiptapEditor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        TiptapEditor::configureUsing(function (TiptapEditor $tiptapEditor) {
            $tiptapEditor->blocks([
                \App\TipTapEditorBlocks\Tabs::class
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app()->setLocale('ar'); 
    }

}


