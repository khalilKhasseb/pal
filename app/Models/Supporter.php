<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;
class Supporter extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia ,HasTranslations;

    protected $fillable = [
        'name',
        'location',
        'about',
        'supported_porject',
        'supported_project_type',
        'contact_info',
        'phone'
    ];

    protected $translatable = [
        'name',
        'location',
        'about',
        'supported_porject',
        'supported_project_type',
    ];


    protected $table = 'supporters';

    public function initiatives() : BelongsToMany {
        return $this->belongsToMany(Initiative::class , 'initiativies_suporters' , 'supporter_id' ,'initiative_id' );
    }

}
