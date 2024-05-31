<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

use App\Models\Scopes\PanelScope;
use App\Models\Scopes\ContentProviderScope;
use App\Models\Panel;
use Illuminate\Support\Facades\Storage;

trait PanelResource
{
    protected static function booted(): void
    {


        //static::addGlobalScope(PanelScope::class);


        // $content_provider = json_decode(Storage::get('content_provider.json')) ;

        //     if ($content_provider->source === 'admin') {
        //         static::withoutGlobalScope(ContentProviderScope::class);
        //         static::addGlobealScope(PanelScope::class);
        //     } elseif ($content_provider->source === 'front') {
        //         static::withoutGlobalScope(PanelScope::class);
        //         static::addGlobalScope(ContentProviderScope::class);
        //     }

    }

    public function panels(): MorphToMany
    {
        return $this->morphToMany(
            Panel::class,
            'resourcables'
        );
    }
}
