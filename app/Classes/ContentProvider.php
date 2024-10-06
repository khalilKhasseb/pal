<?php
namespace App\Classes;
use App\Models\Panel;
class ContentProvider
{


    public static function getActiveContentProvider():mixed
    {
      $activeContentProvdider =  json_decode(file_get_contents(storage_path('app/content_provider.json')), true)['provider'] ?? 'admin';

        return $activeContentProvdider === 'council' ? 'admin' : $activeContentProvdider;
    }

   static function getActivePanelID(): int {
       
        return Panel::findByName(static::getActiveContentProvider())->id;
   }
}