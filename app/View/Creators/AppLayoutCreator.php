<?php

namespace App\View\Creators;

use Illuminate\View\View;
use App\Settings\SiteSetting;

class AppLayoutCreator
{


    public function compose(View $view): void
    {

        $view->with('settings', app(SiteSetting::class));
    }
}
