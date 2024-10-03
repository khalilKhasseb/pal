<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;
use LaraZeus\Sky\SkyPlugin;
use App\Traits\PostResourceTrait;
class ServiceResource extends Resource
{
    // use \App\Traits\ConcielAccess;
    use Translatable, PostResourceTrait;

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $slug = 'service';

    public static function getPostType():string {
        return 'service';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::service()->count();
    }

    static function getPostSlugLabel() : string {
        return __('Services');
    }
    public static function getLabel() :string {
        return __('Service');
    }
    public static function getPluralLabel(): string
    {
        return __('Services');
    }

    public static function getRoute():string {
        return 'service.view' ;
    }

    public static function getModel() : string {
        return SkyPlugin::get()->getModel('Post');
    }

    public static function getEloquentQuery() : Builder {
        return parent::getEloquentQuery()->service();
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return true;
    }
}
