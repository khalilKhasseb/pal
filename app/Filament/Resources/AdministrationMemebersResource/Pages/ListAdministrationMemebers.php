<?php

namespace App\Filament\Resources\AdministrationMemebersResource\Pages;

use App\Filament\Resources\AdministrationMemebersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\Sky\SkyPlugin;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Actions\LocaleSwitcher;
use Illuminate\Database\Eloquent\Builder;


class ListAdministrationMemebers extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = AdministrationMemebersResource::class;

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
            ->where('post_type', 'administration')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
