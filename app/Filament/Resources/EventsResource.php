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
//use App\Models\Scopes\PanelScope;
//use App\Models\Post;

// use Filament\Tables\Actions\EditAction;
// use Filament\Tables\Actions\Action;
// use Filament\Tables\Actions\ActionGroup;
// use Filament\Tables\Actions\DeleteAction;
// use Filament\Tables\Actions\RestoreAction;
// use Filament\Tables\Actions\ForceDeleteAction;

// use App\Models\Post;
// use Filament\Forms;
// use Filament\Forms\Form;
// use Filament\Tables;
// use Filament\Tables\Table;
// use Illuminate\Database\Eloquent\SoftDeletingScope;
// use Filament\Forms\Get;
// use Filament\Forms\Set;
// use Illuminate\Support\Str;
// use Filament\Forms\Components\Tabs;
// use Filament\Tables\Filters\Filter;
// use Filament\Forms\Components\Hidden;
// use Filament\Forms\Components\Select;
// use Filament\Forms\Components\Textarea;
// use Filament\Tables\Columns\TextColumn;
// use Filament\Tables\Columns\ViewColumn;
// use Filament\Forms\Components\TextInput;
// use Filament\Tables\Filters\SelectFilter;
// use Filament\Forms\Components\Placeholder;
// use Filament\Tables\Filters\TrashedFilter;
// use Filament\Forms\Components\ToggleButtons;
// use Filament\Forms\Components\DateTimePicker;
//use Filament\Tables\Actions\DeleteBulkAction;
//use Filament\Tables\Actions\RestoreBulkAction;
//use Filament\Tables\Actions\ForceDeleteBulkAction;
// use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
// use Filament\Forms\Components\Repeater;
// use Guava\FilamentIconPicker\Forms\IconPicker;

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
