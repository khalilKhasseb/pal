<?php

namespace App\SettingsCasts;

use Spatie\LaravelSettings\SettingsCasts\SettingsCast;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HeaderBGCast implements SettingsCast
{


    protected $root = 'site';
    public function get($payload)
    {

        // cast payload
        //dd($payload);
        $payload = strval($payload);

        // $this->ensuerIsAfile($payload);

        return $payload;
    }

    public function set($payload)
    {
        // dd($payload);
        // cast payload
        // $payloadValue = json_decode($payload, true)[app()->getLocale()];
        $cover = DB::table('settings')->where('name', 'header_bg')->first();
        $cover_path = $payload;


        // $path = Str::remove("\"", $site_logo->payload);

        // $payload = strval($payload);
        // check if file is the same after save

        if ($payload !== $cover_path && $this->isThere($cover_path)) $this->delete_file($cover_path);

        return  $payload;
    }


    protected function ensuerIsAfile(string $name)
    {
        // check if file is at storage , filament file uplads a file in public storatge disk
        // check if file when its been set is in dir;
        if (!$this->isThere($name)) {
            return $name;
        }
        return $this->isThere($name);
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
