<?php

namespace App\Settings;

use App\SettingsCasts\UploadFileCast;
use Spatie\LaravelSettings\Settings;

class ContentSettings extends Settings
{
    public string | null $c_about_ar;
    public string | null $c_about_en;
    public string | null $s_about_ar;
    public string | null $s_about_en;
    public string | null $news_ar;
    public string | null $news_en;
    public string | null $contact_ar;
    public string | null $contact_en;
    public string | null $donate_en;
    public string | null $donate_ar;
    public string | null $partners_ar;
    public string | null $partners_en;

    public string|null $s_destintaion;
    public string|null $c_destintaion;

    // public string | null $sommodLogo;
    public string | null $c_about_img;
    public string | null $s_about_img;
    public static function group(): string
    {
        return 'content';
    }

    public static function casts(): array
    {
        return [
            'c_about_img' =>  new UploadFileCast('c_about_img'),
            's_about_img' =>  new UploadFileCast('s_about_img'),
        ];
    }
}
