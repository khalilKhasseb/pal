<?php

namespace App\Classes;

use App\Models\Gallary;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;


//Form Component
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;

use Filament\Forms\Components\Toggle;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Builder as FilamentBuilder;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Component;
use Filament\Forms\Get;
use Filament\Forms\Set;

//#######//

class WidgetsForms
{

    protected static array $widgets = [];
    public static function getWidget(string|null $widget, ?Form $form = null): array
    {

        if (is_null($widget) || empty($widget)) return [];

        $widget = static::validate_widget_name($widget);

        if (!method_exists(__CLASS__, $widget)) return [];

        return [static::$widget($form)];
    }


    // widget name is component named in view folder

    /**
     * check if string containt dash (-)
     * if has dash
     * -remove dash
     * -remove white spaces from left and right
     * -capap case string
     * load widget
     */


    private static function validate_widget_name(string $name): string
    {

        // check if has dashes
        if (Str::contains($name, '-')) {
            $name = Str::of($name)->remove('-')->value();
        }

        if (Str::contains($name, 'component')) {
            $name = Str::of($name)->remove('component')->value();
        }

        $name = Str::of($name)->camel()->value();

        return $name;
    }

    public static function load_components(): array
    {

        // first retrive all files in a given path
        $components = [];
        $finder = app(Finder::class)->in(resource_path('views/components/widgets'))->name('*.blade.php');

        if ($finder->hasResults()) {
            // convert results to array
            // $result = iterator_to_array($finder, false);
            // dont make the the index of generator as index key of array will return a file instance
            foreach ($finder as $file) {
                $compnentNameWithoutExtention = explode('.', $file->getBasename())[0];

                $components[$compnentNameWithoutExtention] = $compnentNameWithoutExtention;
            }
        }

        return $components;
    }


    public static function link(Form $form)
    {
        return Repeater::make('content')
            ->schema([
                TextInput::make('title')
                    ->label(__('Title')),
                TextInput::make('target')
                    ->label(__('Target'))
                    ->url()
                    //->prefix('https://')
                    ->hint('A Url start with https'),
                IconPicker::make('icon')
                    ->label(__('Icon')),
                Toggle::make('icon_only')
                    ->label(__('Icon only'))

            ])
            ->afterStateHydrated(function (Repeater $component) use ($form) {
                !is_null($form->getRecord()) ? $component->state($form->getRecord()->content) : $component;
            })
            ->minItems(0)
            ->maxItems(5);
    }

    public static function contentBoxWithIcons(?Form $form): FilamentBuilder
    {
        return FilamentBuilder::make('content')
            ->blocks([
                FilamentBuilder\Block::make('richText')
                    ->schema([
                        RichEditor::make('richText')
                            ->label(__('Rich Text'))
                    ]),

                FilamentBuilder\Block::make('icons')
                    ->schema([
                        Toggle::make('icons_enable')
                            ->label(__('Enable icons'))
                            ->live(),
                        Repeater::make('icons')
                            ->schema([
                                TextInput::make('title')
                                    ->label(__('Title')),
                                IconPicker::make('icon')
                                    ->label(__('Icon')),
                                ColorPicker::make('color')->label(__('Color'))
                            ])->hidden(fn (Get $get): bool => !$get('icons_enable'))

                    ])
            ]);
    }
    public static function gallary(?Form $form) {
       return Select::make('content')
            ->label(__('gallary'))
            ->options(Gallary::all()->pluck('title', 'id'));
    }

    public static function news()
    {
        //load posts from tags
        // load spicific posts
        return Toggle::make('content')
        ->label(__('Last posts'))
        ->default('1');
    }
}
