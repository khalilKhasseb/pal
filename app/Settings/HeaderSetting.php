<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class HeaderSetting extends Settings
{
    public array $top_header_items;
    public bool $top_header_enabled;
    public static function group(): string
    {
        return 'header_settings';
    }
}
