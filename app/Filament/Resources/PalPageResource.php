<?php

namespace App\Filament\Resources;


use  LaraZeus\Sky\Filament\Resources\PageResource;
use Illuminate\Database\Eloquent\Builder;

class PalPageResource extends PageResource
{

    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->page();
    }


    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::query()->where('post_type', 'page')->count();
    }
}
