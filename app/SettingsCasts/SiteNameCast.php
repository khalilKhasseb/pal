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
        //$this->attributes[$key] = json_encode($translations, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        // $translations[app()->getLocale()] = $payload;
        // $data =  json_encode($translations, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        //dd($payload, $data);
        return $payload;
    }
}
