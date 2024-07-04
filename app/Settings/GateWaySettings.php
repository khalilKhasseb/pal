<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GateWaySettings extends Settings
{


    public  $merchant_id;
    public  $merchant_password;
    public  $acquire_id;
    public  $callback_url;
    public  $autorize_url;
    public int $currency_code;
    public int $currency_exp;
    public string $capture_flag;
    public string $signture_method;
    public string | null $version;
    public static function group(): string
    {
        return 'paymentGateWay';
    }
}
