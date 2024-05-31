<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Storage;

class ContentProviderScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $provider = json_decode(Storage::get('content_provider.json'))->provider;

        $builder->whereHas('panels', function (Builder $query) use ($provider) {
            return $query->where('panels.panel_id', $provider);
        });
    }
}
