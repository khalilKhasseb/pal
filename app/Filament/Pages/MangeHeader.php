<?php

namespace App\Filament\Pages;

use App\Settings\HeaderSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Filament\Forms\Components\ColorPicker;
use App\Filament\Widgets\StatsOverviewWidget;
use Filament\Resources\Concerns\Translatable;
use Filament\Facades\Filament;
// use Filament\Form\Components\Sw
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
class MangeHeader extends SettingsPage
{
    // use Translatable;

    // protected static ?string $navigationGroup = "Settings";
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = HeaderSetting::class;
    // protected static string $settings = 'KHalil';

    public  $top_header_enabled = null;
    public   $top_header_items = null;

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable {
        return __('Manage Header');
    }
      public static function getNavigationGroup(): string {
        return __('Settings');
      }

    public static function getNavigationLabel():string {
        return __('Manage Header');
    }
    public function form(Form $form): Form
    {

        return $form
            ->schema([
                Toggle::make('top_header_enabled')
                ->label(__("Enabel top header"))
                    ->live()
                    ->afterStateUpdated(
                        fn (Toggle $component) => $component
                            ->getContainer()
                            ->getComponent('topHeaderFileds')
                            ->getChildComponentContainer()
                            ->fill()
                    ),
                Grid::make(2)
                    ->schema(function (Get $get) {
                        if ($get('top_header_enabled')) {
                            return [
                                Repeater::make('top_header_items')
                                ->label((__("Top header items")))
                                    ->schema([
                                        TextInput::make('item')
                                        ->label(__("Item")),
                                        IconPicker::make('icon')
                                        ->label(__('Icon')),
                                        ColorPicker::make('color')
                                        ->label(__("Color"))
                                    ])->afterStateHydrated(function (Repeater $component, $state) {
                                        $items = app(HeaderSetting::class)->top_header_items;
                                        $component->state($items);
                                    })->minItems(0)
                                    ->maxItems(3)
                            ];
                        }

                        return [
                            Placeholder::make('notice')->label(__("Notice"))->content(__("Enable top header to add content"))
                        ];
                    })
                    ->key('topHeaderFileds')

            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([
                'name' => 'MacBook Pro',
                'category' => [
                    'name' => 'Laptops',
                ],

            ])
            ->schema([
                TextEntry::make('name'),
                TextEntry::make('category.name'),
            ]);
    }

    // protected function mutateFormDataBeforeSave(array $data): array
    // {
    //     // check if items are filled
    //     $settings = app(static::$settings);

    //     $top_items  = app(HeaderSetting::class)->top_header_items;

    //     if (count($top_items) > 0) {
    //         // check if disabled
    //         if (array_key_exists('top_header_enabled', $data) && !$data['top_header_enabled']) {
    //             $data['top_header_items'] = $top_items;
    //         }
    //     }


    //     foreach ($data as $key => $value) {
    //         // convert value to from json to array
    //         // get Translation
    //         $translation = $settings->getRepository()->getPropertyPayload('header_settings', $key);
    //         // set Translation
    //         $translation[app()->getLocale()] = $value;

    //         $data[$key] = json_encode($translation, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //     }

    //     return $data;
    // }



    protected function mutateFormDataBeforeFill(array $data): array
    {

        return $data;
    }

    public static function canAccess(): bool
    {
        return Filament::getCurrentPanel()->getId() === 'admin';
    }
}
