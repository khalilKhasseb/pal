<?php

namespace App\Models\Blog;

use App\Models\Panel;
use App\Models\Scopes\PanelScope;
use \LaraZeus\Sky\Models\Navigation as Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Translatable\HasTranslations;

class Navigation extends Model
{
    // use HasTranslations;

    // public array $translatable = [
    //     'items',

    // ];
    protected static function booted(): void
    {
        static::addGlobalScope(new PanelScope);
    }

    public function panels(): MorphToMany
    {
        return $this->morphToMany(
            Panel::class,
            'resourcables'
        );
    }
}
