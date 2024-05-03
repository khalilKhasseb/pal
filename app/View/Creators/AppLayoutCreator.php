<?php

namespace App\View\Creators;

use Illuminate\View\View;
use App\Settings\SiteSetting;
use LaraZeus\Sky\SkyPlugin;

class AppLayoutCreator
{


    public function compose(View $view): void
    {
        $categories = SkyPlugin::get()->getModel('Tag')::getWithType('category');
        

        $view
            ->with('settings', app(SiteSetting::class))
            // try to load this data only for side bar ,
            ->with('categories', $categories);
    }
}
