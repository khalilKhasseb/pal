<?php

namespace App\SettingsCasts;

use Spatie\LaravelSettings\SettingsCasts\SettingsCast;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Traits\HasMediaSettings;

class HeaderBGCast implements SettingsCast
{

    use HasMediaSettings;

    protected string $settingProp = 'header_bg';
    public function get($payload)
    {
        return $payload;
    }

    public function set($payload)
    {
        return $this->setSettingPropMedia($payload);
    }
}
