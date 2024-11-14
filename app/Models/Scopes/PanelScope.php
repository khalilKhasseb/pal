<?php

namespace App\Models\Scopes;

use App\Models\Panel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Filament\Facades\Filament;
use App\Models\Post; // Make sure to import your model
use Illuminate\Database\Eloquent\SoftDeletingScope;
class PanelScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {

        $panel = Panel::findById(Filament::getCurrentPanel()->getId());

        if (null !== $panel) {

            $builder->
                whereHas('panels', function (Builder $query) use ($panel, $model) {

                    return $query->whereIn('panels.id', $panel);
                });






        }
    }
}
