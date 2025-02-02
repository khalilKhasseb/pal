<?php

namespace App\Models\Blog;

use \LaraZeus\Sky\Models\Library as Model;
use App\Traits\PanelResource;
class Library extends Model
{

     use PanelResource;

     protected $appends = ['file_url']; // This makes theFile() accessible in JSON responses.


     public function getFileUrlAttribute()
    {
        return $this->theFile();
    }
    
}
