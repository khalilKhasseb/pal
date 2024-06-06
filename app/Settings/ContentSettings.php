<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContentSettings extends Settings
{
    public string $c_about_ar;
    public string $c_about_en;
    public string $s_about_ar;
    public string $s_about_en;
    public string $news_ar;
    public string $news_en;
    public string $contact_ar;
    public string $contact_en;
    public string $donate_en;
    public string $donate_ar;
    public string $partners_ar;
    public string $partners_en;
    public static function group(): string
    {
        return 'content';
    }
}
