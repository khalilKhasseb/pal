<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class HeaderSetting extends Settings
{
    public $top_header_items;
    public  $top_header_enabled;
    public static function group(): string
    {
        return 'header_settings';
    }
}
