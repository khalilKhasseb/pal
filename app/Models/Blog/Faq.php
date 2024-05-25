<?php

namespace App\Models\Blog;

use App\Models\Panel;
use App\Models\Scopes\PanelScope;
use \LaraZeus\Sky\Models\Faq as Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Faq extends Model
{
    protected static function booted(): void
    {
        //static::addGlobalScope(new PanelScope);
    }

    public function panels(): MorphToMany
    {
        return $this->morphToMany(
            Panel::class,
            'resourcables'
        );
    }
}
