<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\Sky\SkyPlugin;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Actions\LocaleSwitcher;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            LocaleSwitcher::make(),
        ];
    }
    protected function getTableQuery(): Builder
    {
        return SkyPlugin::get()->getModel('Post')::query()
            ->where('post_type', 'product')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
