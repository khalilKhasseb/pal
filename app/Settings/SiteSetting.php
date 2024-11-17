<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use App\SettingsCasts\HeaderBGCast;
use App\SettingsCasts\UploadFileCast;
use App\SettingsCasts\SiteNameCast;
use App\SettingsCasts\CommentsCast;

class SiteSetting extends Settings
{
    public mixed $site_name;
    public mixed $site_description;

    public  $site_logo;
    public  string | null $sommod_logo;

    public $header_bg;

    public  $comments_enabled;

    public bool $checkout_enabled;

    public string|null $ar_site_name;
    public string|null $ar_site_description;

    public string|null $subscription_background;

    public static function group(): string
    {
        return 'generalSetting';
    }

    public static function casts(): array
    {
        return [
            'site_logo' => new UploadFileCast('site_logo'),
            'sommod_logo' => new UploadFileCast('sommod_logo'),
            'subscription_background' => new UploadFileCast('subscription_background'),
            'header_bg' => HeaderBGCast::class,
            'site_name' => SiteNameCast::class,
            // "comments_enabled" => CommentsCast::class,
        ];
    }
}
