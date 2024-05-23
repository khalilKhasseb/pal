<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Enums\CropPosition;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Supporter extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia ,HasTranslations;

    protected $fillable = [
        'name',
        'location',
        'website',
        'about',
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

    public function supported_projects() : BelongsToMany {
        return $this->belongsToMany(SupportedProject::class, 'supporters_supported_projects', 'supporter_id', 'supported_project_id');
    }
    public function supported_project_types(): BelongsToMany
    {
        return $this->belongsToMany(SupportedProjectType::class, 'supporters_supported_projects_types', 'supporter_id', 'supported_project_type_id');
    }

    public function panels(): MorphToMany
    {
        return $this->morphToMany(
            Panel::class,
            'resourcables'
        );
    }


    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media|null $media = null): void
    {

        $this->addMediaConversion('thumb-cropped')
            ->performOnCollections('thumbnail')
            ->crop(380, 300, CropPosition::Center);

      
        $this->addMediaConversion('thumb-cropped-original')
            ->performOnCollections('supporters')
            ->fit(Fit::Fill, 380, 300, false, '#333');


    }

}
