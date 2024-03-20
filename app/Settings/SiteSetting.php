<?php

namespace App\Settings;

use App\SettingsCasts\HeaderBGCast;
use Spatie\LaravelSettings\Settings;
use App\SettingsCasts\UploadFileCast;

class SiteSetting extends Settings
{
    public string $site_name;
    public string $site_description;

    public  $site_logo;

    public $header_bg;
    public static function group(): string
    {
        return 'generalSetting';
    }

    public static function casts(): array
    {
        return [
            'site_logo' => UploadFileCast::class,
            'header_bg' => HeaderBGCast::class,
        ];
    }
}
