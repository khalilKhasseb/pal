<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Traits\PanelResource;
class Initiative extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia , HasTranslations , PanelResource;

    protected $table = 'initiativies';
    protected $fillable = ['title', 'slug', 'type'];
    protected $translatable = ['title'];


    public function supporters(): BelongsToMany
    {
        return $this->belongsToMany(Supporter::class, 'initiativies_suporters', 'initiative_id', 'supporter_id');
    }


}
