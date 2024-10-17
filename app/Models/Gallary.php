<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\PanelResource;
class Gallary extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations;

    use HasFactory;
    use PanelResource;
    protected $fillable = ['title', 'show_in_slider'];

    protected $translatable = ['title'];

    protected $casts = ['show_in_slider' => 'boolean'];

    public function scopeShowInSlider(Builder $builder): Builder
    {
        return $builder->where('show_in_slider', 1);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'gallary_id', 'id');
    }


    public function registerMediaConversions(Media $media = null): void
    {

        $this->addMediaConversion('fit-slider')
            ->performOnCollections('gallary')
            ->fit(\Spatie\Image\Enums\Fit::Fill, 1200, 400, false, '#333');


    }


}
