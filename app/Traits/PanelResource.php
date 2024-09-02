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
        parent::booted();

       
        if (app()->runningInConsole())
            return;
        $content_provider = json_decode(Storage::get('content_provider.json'));
        if(is_null($content_provider)) return ;
        // dd($content_provider);
        if(str_contains($content_provider->source , 'filament')) {
            static::withoutGlobalScope(ContentProviderScope::class);
            static::addGlobalScope(PanelScope::class);
        }
         elseif (
            !str_contains($content_provider->source, 'filament')
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
