<?php

namespace App\Filament\Resources;
use App\Filament\Resources\EventsResource\Pages;
// use App\Filament\Resources\EventsResource\RelationManagers;
use App\Filament\Resources\PostResource\RelationManagers\PostMetaRelationManager;
use App\Traits\PostResourceTrait;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Concerns\Translatable;
use LaraZeus\Sky\SkyPlugin;

class EventsResource extends Resource
{
    use Translatable , PostResourceTrait;

    protected static ?string $slug = 'events';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?int $navigationSort = 4;

    public static function getModel(): string
    {
       
        return SkyPlugin::get()->getModel('Post');
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->event();
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::event()->count();
    }



    public static function getNavigationLabel(): string
    {
        return __('Events');
    }

    public static function getLabel(): string
    {
        return __('Event');
    }

    public static function getPluralLabel(): string
    {
        return __('Events');
    }

    public static function getPostType():string {
        return 'event';
    }

    public static function getPostSlugLabel() : string {
        return __('Event slug');
    }
     public static function getRoute() : string {
        return 'event.single';
     }
    public static function getRelations(): array
    {
        return [
            PostMetaRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvents::route('/create'),
            'edit' => Pages\EditEvents::route('/{record}/edit'),
        ];
    }

   


}
