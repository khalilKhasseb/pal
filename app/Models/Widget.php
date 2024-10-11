<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Translatable\HasTranslations;
use App\Traits\PanelResource;

class Widget extends Model
{
    use HasFactory, HasTranslations, PanelResource;
    protected $fillable = ['title', 'location', 'content', 'component', 'type'];
    protected $translatable = ['title', 'content'];
    protected $casts = [
        'content' => 'array'
    ];


    public function scopeLocation(Builder $query, string $location): void
    {
        $query->where('location', $location);
    }

    public function scopeType(Builder $query, string $type): void
    {

        $query->where('component', $type);
    }

    public function links() : MorphMany {
        return $this->morphMany(Links::class , 'linkable');
    }
}
