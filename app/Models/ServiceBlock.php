<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ServiceBlock extends Model implements HasMedia
{
    use HasFactory , HasTranslations , InteractsWithMedia;

    protected $fillable = ['title', 'content', 'icon'];
    protected $translatable = ['title', 'content'];

    protected $table = 'services_blocks';
    public function image(string $collection = 'service_image')
    {
        if (!$this->getMedia($collection)->isEmpty()) {
            return $this->getFirstMediaUrl($collection);
        } else {
            false;
        }
    }

}
