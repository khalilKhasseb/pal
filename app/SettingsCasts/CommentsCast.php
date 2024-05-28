<?php

namespace App\SettingsCasts;

use Spatie\LaravelSettings\SettingsCasts\SettingsCast;

class CommentsCast implements SettingsCast
{

    public function get($payload)
    {

        return (bool) $payload;
    }

    public function set($payload)
    {
       
        return (bool) $payload;
    }
}
