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
        $content_provider = json_decode(Storage::get('content_provider.json'));

        if ($content_provider->provider === 'admin') {
            static::withoutGlobalScope(ContentProviderScope::class);
            static::addGlobalScope(PanelScope::class);
        } elseif (
            $content_provider->provider === 'sommod'
            || $content_provider->provider === 'council'
        ) {
            static::withoutGlobalScope(PanelScope::class);
            static::addGlobalScope(ContentProviderScope::class);
        }
    }

    public function panels(): MorphToMany
    {
        return $this->morphToMany(
            Panel::class,
            'resourcables'
        );
    }
}
