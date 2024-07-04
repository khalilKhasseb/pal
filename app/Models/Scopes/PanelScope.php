<?php

namespace App\Models\Scopes;

use App\Models\Panel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Filament\Facades\Filament;

class PanelScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {

        $panelName  = Filament::getCurrentPanel()->getId() !== 'admin' ? Filament::getCurrentPanel()->getId() : '';

        $panel = Panel::findByName($panelName);
        if (null !== $panel) {

            $builder->whereHas('panels', function (Builder $query) use ($panel) {

                return $query->whereIn('panels.id', $panel);
            });
        }
    }
}
