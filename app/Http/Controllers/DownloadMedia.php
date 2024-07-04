<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadMedia extends Controller
{
    public function __invoke(\Spatie\MediaLibrary\MediaCollections\Models\Media $media) {
        
        return $media ;
    }
}
