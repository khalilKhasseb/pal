<?php

namespace App\Filament\Resources\TagResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use LaraZeus\Sky\SkyPlugin;
use Livewire\Component as Livewire;

class ChildrenRelationManager extends RelationManager
{
    protected static string $relationship = 'children';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label(__('Name'))
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {

                        $slug = Str::slug($state);
                        $tagModel = !is_null(SkyPlugin::get()->getModel('Tag')::findBySlug($slug, 'faq'))
                        ?SkyPlugin::get()->getModel('Tag')::findBySlug($slug, 'faq')->exists()
                        : false;
                        if($tagModel) {
                            // dd(SkyPlugin::get()->getModel('Tag')::findBySlug($slug , 'faq'));
                           $incementalslug = $state.'-'.SkyPlugin::get()->getModel('Tag')::where('slug' , 'like' , '%'.Str::slug($state).'%')
                           ->where('type' , 'faq')
                           ->get()->count() + 1;

                           $set('slug' , Str::slug($incementalslug));
                        }else{
                          $set('slug', Str::slug($state));
                        }
                        $set('name' , $state.'-'.$this->getOwnerRecord()->name);
                    }),

                            Forms\Components\TextInput::make('slug')
                            ->label(__('Slug'))
                            ->unique(ignorable: fn (?Model $record): ?Model => $record)
                            ->required()
                            ->maxLength(255),
                            Forms\Components\Select::make('type')
                            ->label(__('Type'))
                            ->columnSpan(2)
                            ->options(SkyPlugin::get()->getTagTypes())
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('parent.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
