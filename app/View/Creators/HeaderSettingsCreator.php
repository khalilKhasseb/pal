<?php

namespace App\View\Creators;

use Illuminate\View\View;
use App\Settings\HeaderSetting;

class   HeaderSettingsCreator
{


    public function compose(View $view)
    {

        $view->with([
         'header_settings' => app(HeaderSetting::class),
        // 'menu' =>  \LaraZeus\Sky\SkyPlugin::get()->getModel('Navigation')::fromHandle('main-header-menu')
        ]);
    }
}
