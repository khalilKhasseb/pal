<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;

class Gallary extends Model implements HasMedia
{
    use InteractsWithMedia , HasTranslations;

    use HasFactory;
    protected $fillable = ['title' , 'show_in_slider'];

    protected $translatable = ['title'];

    protected $casts = ['show_in_slider' => 'boolean'];

    public function scopeShowInSlider(Builder $builder) : Builder {
        return $builder->where('show_in_slider', 1);
    }

}
