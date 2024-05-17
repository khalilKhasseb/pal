<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\Sky\SkyPlugin;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Actions\LocaleSwitcher;
use Illuminate\Database\Eloquent\Builder;

class ListActivities extends ListRecords
{    use ListRecords\Concerns\Translatable;

    protected static string $resource = ActivityResource::class;

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
            ->where('post_type', 'activity')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
