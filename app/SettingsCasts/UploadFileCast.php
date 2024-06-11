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


        $site_logo = DB::table('settings')->where('name', 'site_logo')->first();

        // $path = Str::remove("\"", $site_logo->payload);
        $path = $site_logo->payload;




        if ($payload !== $path && $this->isThere($path)) $this->delete_file($path);

        return  $payload;
    }

    private function isThere($path)
    {
        if ($path === null) return false;
        return Storage::disk('public')->exists($path);
    }

    protected function delete_file(string $path)
    {

        Storage::disk('public')->delete($path);
    }
}
