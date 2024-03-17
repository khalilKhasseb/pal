<?php

namespace App\SettingsCasts;

use Exception;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelSettings\SettingsCasts\SettingsCast;

class UploadFileCast implements SettingsCast
{

    protected $root = 'site';
    public function get($payload)
    {

        // cast payload
        $payload = strval($payload);

        $this->ensuerIsAfile($payload);

        return $payload;
    }

    public function set($payload)
    {
        // cast payload
        $payload = strval($payload);

        $this->ensuerIsAfile($payload);

        return  $payload;
    }


    protected function ensuerIsAfile(string $name)
    {
        // check if file is at storage , filament file uplads a file in public storatge disk
        // check if file when its been set is in dir;
        if (!$this->isThere($name)) {
            throw new Exception('Contact Support company Or file is not in the storage');
        }
        return $this->isThere($name);
    }


    private function isThere($path)
    {

        return Storage::disk('public')->exists($path);
    }
}
