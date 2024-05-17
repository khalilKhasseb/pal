<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnersResource\Pages;
use App\Filament\Resources\PartnersResource\RelationManagers;
use App\Models\Partners;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Traits\PostResourceTrait;
use Filament\Resources\Concerns\Translatable;
use LaraZeus\Sky\SkyPlugin;

class PartnersResource extends Resource
{
    use Translatable, PostResourceTrait;
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $slug = 'partners';


    public static function getModel() : string {
        return SkyPlugin::get()->getModel('Post');
    }

    public static function getEloquentQuery() : Builder{

        return parent::getEloquentQuery()->partner();
    }

    public static function getLabel() : string {
        return __('Partner');
    }
    

    public static function getPostType() : string {
        return 'partner';
    }

    public static function getPostSlugLabel() : string {
        return __('Partner');
    }

    public static function getNavigationLabel(): string
    {
        return __("Partners");
    }

    public static function getModelLabel(): string
    {
        return __("Partner");
    }

    public static function getPluralLabel(): string
    {
        return __("Partners");
    }
    public static function getRoute() : string {
        return 'partners.view';
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartners::route('/create'),
            'edit' => Pages\EditPartners::route('/{record}/edit'),
        ];
    }
}
