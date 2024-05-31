<?php

namespace App\Models\Blog;

use App\Models\Panel;
use App\Models\Scopes\PanelScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use \LaraZeus\Sky\Models\Tag as Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
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

    public function parent():BelongsTo {
        return $this->belongsTo(self::class ,'parent_id');
    }
    public function children():HasMany {
        return $this->hasMany(self::class,'parent_id');
    }


}
