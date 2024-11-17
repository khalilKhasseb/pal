<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Storage;

class ContentProviderScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder with enhanced logic.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $provider = json_decode(Storage::disk('local')->get('content_provider.json'))->provider ?? 'default';

        if ($provider === 'council') {
            $provider = 'admin';
        }

        $builder->whereHas('panels', function (Builder $query) use ($provider) {
            $query->where('panels.panel_id', $provider);

            // Additional conditions can be added here for enhanced logic
            //$query->where('panels.is_active', true);
        });
    }
}
