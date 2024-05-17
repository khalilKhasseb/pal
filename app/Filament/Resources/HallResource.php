<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HallResource\Pages;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\PostResourceTrait;
use Filament\Resources\Concerns\Translatable;
use LaraZeus\Sky\SkyPlugin;
// use Illuminate\Database\Eloquent\SoftDeletingScope;

class HallResource extends Resource
{
    use Translatable, PostResourceTrait;

    protected static ?string $slug = 'halls';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    // protected static ?int $navigationSort = 4;

    public static function getModel(): string
    {

        return SkyPlugin::get()->getModel('Post');
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->halls();
    }

    public static function getNavigationLabel(): string
    {
        return __('Hall');
    }

   

    public static function getPostType(): string
    {
        return 'hall';
    }
    public static function getLabel(): string
    {
        return __('Hall');
    }

    public static function getPluralLabel(): string
    {
        return __('Halls');
    }

    public static function getPostSlugLabel(): string
    {
        return __('Slug');
    }
    public static function getRoute(): string
    {
        return 'hall.view';
    }
    public static function getRelations(): array
    {
        return [
            //PostMetaRelationManager::class
        ];
    }  
      public static function getPages(): array
    {
        return [
            'index' => Pages\ListHalls::route('/'),
            'create' => Pages\CreateHall::route('/create'),
            'edit' => Pages\EditHall::route('/{record}/edit'),
        ];
    }
    public static function canAccess(): bool
    {
        return filament()->getCurrentPanel()->getId() === 'admin';
    }
}
