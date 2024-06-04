<?php

namespace App\SettingsCasts;

use Spatie\LaravelSettings\SettingsCasts\SettingsCast;

class SiteNameCast implements SettingsCast
{


    public function get($payload)
    {


        return $payload;
    }

    public function set($payload)
    {
        return $payload;
    }
}
