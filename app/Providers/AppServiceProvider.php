<?php

namespace App\Providers;


use Filament\Forms\Form;
use Illuminate\Support\ServiceProvider;
use FilamentTiptapEditor\TiptapEditor;
use LaraZeus\Sky\Filament\Resources\TagResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    //  $r = TagResource::form(app(Form::class));
        
        
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


