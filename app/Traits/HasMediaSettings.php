<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

trait HasMediaSettings
{


    public function getSettingProp()
    {
        return $this->settingProp;
    }

    public function setSettingPropMedia(string | null $payload)
    {
        // first get setting prop database value

        $originalPath = DB::table('settings')->where('name', $this->getSettingProp())->first()->payload;
        $originalPath = json_decode($originalPath);

        if ($payload !== $originalPath && $this->isThere($originalPath)) $this->delete_file($originalPath);

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
        if ($path === null) return false;
        return Storage::disk('public')->exists($path);
    }

    protected function delete_file(string $path)
    {

        Storage::disk('public')->delete($path);
    }
}
