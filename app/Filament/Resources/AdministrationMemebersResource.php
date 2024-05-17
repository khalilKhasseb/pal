<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdministrationMemebersResource\Pages;
use App\Filament\Resources\AdministrationMemebersResource\RelationManagers\LinksRelationManager;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\PostResourceTrait;

use App\Models\Post;
use LaraZeus\Sky\SkyPlugin;
use Filament\Resources\Concerns\Translatable;

class AdministrationMemebersResource extends Resource
{
    use Translatable, PostResourceTrait;
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $slug = 'administration';




    public static function getPostType() : string {
        return 'administration';
    }

    public static function getLabel() :string {
        return __('Administration');
    }

    public static function getPostSlugLabel() : string {
        return __('Administration');
    }
    public static function getPluralLabel(): string
    {
        return __('Administrations');
    }


    public static function getRoute() : string {
        return 'administration.view';
    }

    public static function getModel(): string
    {

        return SkyPlugin::get()->getModel('Post');
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->administration();
    }
     public static function getRelations(): array  {

        return [
            LinksRelationManager::class,
        ];
      }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdministrationMemebers::route('/'),
            'create' => Pages\CreateAdministrationMemebers::route('/create'),
            'edit' => Pages\EditAdministrationMemebers::route('/{record}/edit'),
        ];
    }

    public static function canAccess() : bool {
        return filament()->getCurrentPanel()->getId() === 'admin';
    }
}
