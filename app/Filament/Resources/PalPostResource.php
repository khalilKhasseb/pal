<?php

namespace App\Filament\Resources;


use LaraZeus\Sky\Filament\Resources\PostResource as Resource;
use Illuminate\Database\Eloquent\Builder;

class PalPostResource extends Resource
{

    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('post_type', 'post');
    }


    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::query()->where('post_type', 'post')->count();
    }

    // protected static function

    protected function mutateFormDataBeforeCreate(array $data)
    {

        // dd($data);

         return $data;
    }

    // protected function mutate
}
