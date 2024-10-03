<?php

namespace App\View\Creators;

use Filament\Facades\Filament;
use Illuminate\View\View;
use App\Settings\SiteSetting;
use LaraZeus\Sky\SkyPlugin;

class AppLayoutCreator
{


    public function compose(View $view): void
    {
       
        // $categories = SkyPlugin::get()->getModel('Tag')::getWithType('category');

        // $footerMenus = SkyPlugin::get()->getModel('Navigation')::where('handle' ,'like' ,'%footer-%')->get();
        $view
            ->with('settings', app(SiteSetting::class))
            // try to load this data only for side bar ,
            // ->with('categories', $categories)
            // ->with('footerMenus' , $footerMenus)
        ;
    }
}
