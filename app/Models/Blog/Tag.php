<?php

namespace App\Models\Blog;

use App\Models\Panel;
// use App\Models\Scopes\PanelScope;
use App\Traits\PanelResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use \LaraZeus\Sky\Models\Tag as Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Builder;
// use App\Traits\PanelResource;
class Tag extends Model
{
    use PanelResource;

   
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function service(): MorphToMany
    {
        return $this->morphedByMany(config('zeus-sky.models.Post'), 'taggable');
    }

    


}
