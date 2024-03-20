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

class MangeHeader extends SettingsPage
{
    protected static ?string $navigationGroup = "Settings";
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = HeaderSetting::class;

    public ?bool $top_header_enabled = null;
    public ?array $top_header_items = null;
    public function form(Form $form): Form
    {
        // $items = app(HeaderSetting::class)->top_header_items;
        return $form
            ->schema([
                Toggle::make('top_header_enabled')
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
                                    ->schema([
                                        TextInput::make('item'),
                                        IconPicker::make('icon'),
                                        ColorPicker::make('color')
                                    ])->afterStateHydrated(function (Repeater $component, $state) {
                                        $items = app(HeaderSetting::class)->top_header_items;
                                        $component->state($items);
                                    })->minItems(0)
                                    ->maxItems(3)
                            ];
                        }

                        return [
                            Placeholder::make('notice')->content('Enable top header to add content')
                        ];
                    })
                    ->key('topHeaderFileds')

            ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // check if items are filled
        $top_items  = app(HeaderSetting::class)->top_header_items;
        if (count($top_items) > 0) {
            // check if disabled
            if (array_key_exists('top_header_enabled', $data) && !$data['top_header_enabled']) {
                $data['top_header_items'] = $top_items;
            }
        }
        return $data;
    }
}
