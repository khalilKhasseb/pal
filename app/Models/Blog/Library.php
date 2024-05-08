<?php

namespace App\Models\Blog;

use App\Models\Panel;
use App\Models\Scopes\PanelScope;
use \LaraZeus\Sky\Models\Library as Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Library extends Model
{
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
