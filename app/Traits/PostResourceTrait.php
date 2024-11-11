<?php

namespace App\Traits;
//Laravel
use Illuminate\Database\Eloquent\Builder;
//end

// Form models
use App\Models\Post;
//
// use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Form;
//Form
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Placeholder;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Filament\Forms\Components\SpatieTagsInput;

// Table
use Filament\Tables\Actions\DeleteBulkAction;
// use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;

//End

//Actions
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\ForceDeleteAction;
//End
//Packages dependanices
use LaraZeus\Sky\SkyPlugin;
use Illuminate\Support\Str;

//others
use App\Models\Scopes\PanelScope;
use Illuminate\Database\Eloquent\Model;
use TomatoPHP\FilamentMediaManager\Form\MediaManagerInput;

trait PostResourceTrait
{

    protected static $post_type = 'post';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('post_tabs')->schema([
                Tabs\Tab::make(__('Title & Content'))->schema([
                    
                    TextInput::make('title')
                        ->label(static::getLabel() . " " . __('Title'))
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, $state) {
                            $set('slug', Str::slug($state));
                        }),
                    config('zeus-sky.editor')::component()
                        ->label(__("Post Content")),

                    Select::make(__('Panel'))
                        ->multiple()
                        ->relationship('panels', titleAttribute: 'panel_name')
                        ->preload(),
                    Select::make('google_form_id')
                        ->relationship(name: 'form', titleAttribute: 'name')
                        ->preload(),
                    Section::make(__('Custom fields'))
                        ->schema([
                            Repeater::make('post_meta')
                                ->label(__("Fields"))
                                ->relationship()
                                ->schema([
                                    TextInput::make('key')
                                        ->label(__('Title')),
                                    TextInput::make('value')
                                        ->label(__('Value')),
                                    IconPicker::make('icon')
                                        ->label(__('Icon'))
                                ])
                        ]),

                ]),
                Tabs\Tab::make(__('SEO'))->schema([
                    Hidden::make('user_id')
                        ->required()
                        ->default(auth()->user()->id),

                    Hidden::make('post_type')
                        ->default(static::getPostType())
                        ->required(),

                    Textarea::make('description')
                        ->maxLength(255)
                        ->label(__('Description'))
                        ->hint(__('Write an excerpt for your ') . static::getLabel()),

                    TextInput::make('slug')
                        ->unique(ignorable: fn(?Post $record): ?Post => $record)
                        ->required()
                        ->maxLength(255)
                        ->label(__("Slug")),


                    // Select::make('parent_id')
                    //     ->options(
                    //         SkyPlugin::get()->getModel('Post')::where('post_type', static::getPostType())->pluck(
                    //             'title',
                    //             'id'
                    //         )
                    //     )
                    //     ->label(__('Parent')),

                    TextInput::make('ordering')
                        ->integer()
                        ->label(__('Order'))
                        ->default(1),
                ]),
                Tabs\Tab::make(__('Tags'))->schema([
                    Placeholder::make(__('Tags and Categories')),
                    SpatieTagsInput::make('tags')
                        ->type('tag')
                        ->label(__('Tags')),

                    // SpatieTagsInput::make('category')
                    //     ->type('category')
                    //     ->label(__('Categories')),
                    SpatieTagsInput::make(static::getPostType())
                        ->type(static::getPostType())
                        ->label(__('Type Category')),
                ]),

                Tabs\Tab::make(__('Visibility'))->schema([
                    Placeholder::make(__('Visibility Options')),
                    Select::make('status')
                        ->label(__('status'))
                        ->default('publish')
                        ->required()
                        ->live()
                        ->options(SkyPlugin::get()->getModel('PostStatus')::pluck('label', 'name')),

                    TextInput::make('password')
                        ->label(__('Password'))
                        ->visible(fn(Get $get): bool => $get('status') === 'private'),

                    DateTimePicker::make('published_at')
                        ->label(__('published at'))
                        ->required()
                        ->native(false)
                        ->default(now()),

                    DateTimePicker::make('sticky_until')
                        ->native(false)
                        ->label(__('Sticky Until')),
                ]),

                Tabs\Tab::make(__('Image'))->schema([
                    Placeholder::make(__('Featured Image')),
                    ToggleButtons::make('featured_image_type')
                        ->dehydrated(false)
                        ->hiddenLabel()
                        ->live()
                        ->afterStateHydrated(function (Set $set, Get $get) {
                            $setVal = ($get('featured_image') === null) ? 'upload' : 'url';
                            $set('featured_image_type', $setVal);
                        })
                        ->grouped()
                        ->options([
                            'upload' => __('upload'),
                            'url' => __('url'),
                        ])->columnSpanFull()
                        ->default('upload'),
                    SpatieMediaLibraryFileUpload::make('featured_image_upload')
                        ->collection('posts')
                        ->disk(SkyPlugin::get()->getUploadDisk())
                        ->directory(SkyPlugin::get()->getUploadDirectory())
                        ->visible(fn(Get $get) => $get('featured_image_type') === 'upload')
                        ->label(''),
                    TextInput::make('featured_image')
                        ->label(__('featured image url'))
                        ->visible(fn(Get $get) => $get('featured_image_type') === 'url')
                        ->url(),
                    Section::make()
                        ->label(__('Thumbnail'))
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('thumbnail_upload')
                                ->label(__('Thumbnail'))
                                ->collection('thumbnail')
                                ->disk(SkyPlugin::get()->getUploadDisk())
                                ->directory(SkyPlugin::get()->getUploadDirectory())
                                ->live()
                                ->afterStateHydrated(function ($state, ?\LaraZeus\Sky\Models\Post $record, Get $get, Set $set, string $operation) {
                                    // state is null on create , empty array on edit
                                    // do clear thubnail collection when adding a custom thubnail
                                    $has_thmb = $get('has_thumb') === null ? false : $get('has_thumb');

                                    if ($operation === 'edit') {
                                    }
                                    if ($operation === 'create') {
                                    }
                                    if (is_null($state) || empty($state) && is_null($record) || !$has_thmb) {
                                        $has_thmb = $has_thmb;
                                    }
                                    if (!is_null($state) && is_array($state) && !empty($state) && !$has_thmb) {
                                        $has_thmb = true;
                                    }
                                    $set('has_thumb', $has_thmb);
                                }),
                            Checkbox::make('has_thumb')
                                ->label('Has thmbnail')
                                ->required()
                        ])
                ]),

                Tabs\Tab::make(__('Attachment'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('attachments')
                            ->label(__('Attachments'))
                            ->acceptedFileTypes(['application/msword', 'application/pdf', 'text/plain'])
                            ->minSize(1)
                            ->maxSize(1024 * 4)
                            ->multiple()
                            ->preserveFilenames()
                            ->collection('attachments')
                            ->directory('attachments')
                            ->dehydrated(false)

                    ])
            ])->columnSpan(2),
        ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('title_card')
                    ->label(__('Title'))
                    ->sortable(['title'])
                    ->searchable(['title'])
                    ->toggleable()
                    ->view('zeus::filament.columns.post-title'),

                ViewColumn::make('status_desc')
                    ->label(__('Status'))
                    ->sortable(['status'])
                    ->searchable(['status'])
                    ->toggleable()
                    ->view('zeus::filament.columns.status-desc')
                    ->tooltip(fn(Post $record): string => $record->published_at->format('Y/m/d | H:i A')),
                SpatieTagsColumn::make('tags')
                    ->label(__('Post Tags'))
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->type('tag'),
                SpatieTagsColumn::make('category')
                    ->label(__('Post Category'))
                    ->toggleable()
                    ->type(self::getTagType()),

                TextColumn::make('panels.panel_name')
                    ->label(__('Panel')),

            ])
            ->defaultSort('id', 'desc')
            ->actions(static::getActions())
            ->bulkActions([
                DeleteBulkAction::make(),
                ForceDeleteBulkAction::make(),
                RestoreBulkAction::make(),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('status')
                    ->multiple()
                    ->label(__('Status'))
                    ->options(SkyPlugin::get()->getModel('PostStatus')::pluck('label', 'name')),
                Filter::make('password')
                    ->label(__('Password Protected'))
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('password')),
            ]);
    }
    public static function getActions(): array
    {
        $action = [
            EditAction::make('edit')->label(__('Edit')),
            Action::make('Open')
                ->color('warning')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->label(__('Open'))
                ->url(fn(Post $record): string => route(static::getRoute(), ['slug' => $record]))
                ->openUrlInNewTab(),
            DeleteAction::make('delete'),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];



        return [ActionGroup::make($action)];
    }

    protected function afterCreate(?Model $record): void
    {
        dd($record->tags);
        //$record->tags()->panels()->sync()
    }

    protected static function getTagType(): string
    {
        return match (static::getPostType()) {
            'post' => 'category',
            default => static::getPostType()
        };
    }
}
