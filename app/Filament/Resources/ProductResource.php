<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Traits\PostResourceTrait;
use Filament\Resources\Concerns\Translatable;
use LaraZeus\Sky\SkyPlugin;
use App\Models\Post;
use App\Filament\Resources\AdministrationMemebersResource\RelationManagers\LinksRelationManager;
class ProductResource extends Resource
{
    use Translatable, PostResourceTrait;

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $slug = 'product';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::product()->count();
    }


    public static function getPostType(): string
    {
        return 'product';
    }

    public static function getNavigationLabel(): string
    {
        return __("Products");
    }

    public static function getModelLabel(): string
    {
        return __("Product");
    }

    public static function getPluralLabel(): string
    {
        return __("Products");
    }

    public static function getPostSlugLabel(): string
    {
        return __('Products');
    }

    public static function getRoute(): string
    {
        return 'product.view';
    }

    public static function getModel(): string
    {

        return SkyPlugin::get()->getModel('Post');
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->product();
    }

    public static function getRelations(): array
    {
        return [
            LinksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
