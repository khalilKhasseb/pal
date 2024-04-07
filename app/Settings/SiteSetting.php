<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use App\SettingsCasts\HeaderBGCast;
use App\SettingsCasts\UploadFileCast;
use App\SettingsCasts\SiteNameCast;

class SiteSetting extends Settings
{
    public mixed $site_name;
    public mixed $site_description;

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
            'site_name' => SiteNameCast::class,
        ];
    }
}
