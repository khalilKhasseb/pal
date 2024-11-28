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

        return;
        // if (app()->runningInConsole())
        //     return;
        $content_provider = json_decode(Storage::disk('local')->get('content_provider.json'));
        if (is_null($content_provider)) {

            return;
        }
        if (str_contains($content_provider->source, 'filament')) {
            static::withoutGlobalScope(ContentProviderScope::class);    
            static::addGlobalScope(PanelScope::class);
        } elseif (
            !str_contains($content_provider->source, 'filament')
        ) {
            static::withoutGlobalScope(PanelScope::class);
            static::addGlobalScope(ContentProviderScope::class);
        }

        

        // static::deleted(function ($record) {
        //     $record->panels()->detach();
        // });
    }

    public function panels(): MorphToMany
    {
        return $this->morphToMany(
            Panel::class,
            'resourcables'
        );
    }
}
