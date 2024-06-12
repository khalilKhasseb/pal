<?php

namespace App\SettingsCasts;

use Illuminate\Support\Facades\Storage;
use Spatie\LaravelSettings\SettingsCasts\SettingsCast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Traits\HasMediaSettings;

class UploadFileCast implements SettingsCast
{

    use HasMediaSettings;
    protected string $settingProp = 'site_logo';

    public function __construct(string $prop)
    {
       $this->settingProp = $prop ;
    }
    public function get($payload)
    {
        return $payload;
    }

    public function set($payload)
    {

        return  $this->setSettingPropMedia($payload);
    }
}
