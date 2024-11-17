<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpertResource\Pages;
use App\Filament\Resources\ExpertResource\RelationManagers;
use App\Models\Expert;
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

class ExpertResource extends Resource
{
    use Translatable, PostResourceTrait;
    //protected static ?string $model = Expert::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $slug = 'exprts';


    public static function getLabel(): string
    {
        return __('Experts');
    }

    public static function getPostSlugLabel(): string
    {
        return __('Expert');
    }
    public static function getPluralLabel(): string
    {
        return __('Experts');
    }

    public static function getModel(): string
    {

        return SkyPlugin::get()->getModel('Post');
    }
   
    public static function getModelLabel(): string
    {
        return __('Expert');
    }
    public static function getPostType():string {
        return 'expert';
    }

    public static function getEloquentQuery() : Builder {
        return parent::getEloquentQuery()->where('post_type' , 'expert');
    }

    public static function getRoute(): string
    {
        return 'administration.view';
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperts::route('/'),
            'create' => Pages\CreateExpert::route('/create'),
            'edit' => Pages\EditExpert::route('/{record}/edit'),
        ];
    }
}
