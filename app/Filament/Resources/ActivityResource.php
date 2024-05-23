<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Filament\Resources\ActivityResource\RelationManagers;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use LaraZeus\Sky\SkyPlugin;
use App\Traits\PostResourceTrait;
use Filament\Resources\Concerns\Translatable;

class ActivityResource extends Resource
{
  
    use Translatable, PostResourceTrait;
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $slug = 'activity';




    public static function getPostType(): string
    {
        return 'activity';
    }

    public static function getLabel(): string
    {
        return __('Activity');
    }

    public static function getPostSlugLabel(): string
    {
        return __('Activities');
    }
    public static function getPluralLabel(): string
    {
        return __('Activities');
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::activites()->count();
    }



    public static function getRoute(): string
    {
        return 'activity.view';
    }

    public static function getModel(): string
    {

        return SkyPlugin::get()->getModel('Post');
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->activites();
    }

    public static function canAccess(): bool
    {
        return filament()->getCurrentPanel()->getId() === 'admin';
    }

    // public static function getRelations(): array
    // {
    //     return [
    //         //
    //     ];
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
