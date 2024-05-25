<?php

namespace App\SettingsCasts;

use Illuminate\Support\Facades\Storage;
use Spatie\LaravelSettings\SettingsCasts\SettingsCast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UploadFileCast implements SettingsCast
{

    protected $root = 'site';
    public function get($payload)
    {

        // cast payload
        $payload = strval($payload);

        //$this->ensuerIsAfile($payload);

        return $payload;
    }

    public function set($payload)
    {
        // cast payload
        $payloadValue = json_decode($payload, true)[app()->getLocale()];

        // check if is null

        if(is_null($payloadValue)) return $payload ;

        // if not null do save and delete

        // get path

        $site_logo = DB::table('settings')->where('name', 'site_logo')->first();

        // $path = Str::remove("\"", $site_logo->payload);
        $path = json_decode($site_logo->payload,true)[app()->getLocale()];

        // dd($path , $payloadValue);



        if ($payloadValue !== $path && $this->isThere($path)) $this->delete_file($path);

        return  $payload;
    }

    private function isThere($path)
    {

        return Storage::disk('public')->exists($path);
    }

    protected function delete_file(string $path)
    {

        Storage::disk('public')->delete($path);
    }
}
