<?php
namespace App\Classes;
use Filament\Forms\Components\Select;
use LaraZeus\Sky\SkyPlugin;

class ExtraNavFields {
  public static function initFields() : void {
        SkyPlugin::get()->itemType(__('Catoery'), [
            Select::make('category_id')
                ->searchable()
                ->options(function () {
                    return SkyPlugin::get()->getModel('Tag')::whereIn('type', SkyPlugin::get()->getModel('Tag')::getTypes())->pluck('name', 'id')->map(fn($tag) => preg_replace('/\n/', '', $tag));
                })
        ], 'category');

        SkyPlugin::get()->itemType(__('Sommod Routes'), [
            Select::make('sommod_routes')
                ->label(__('Sommod Routes'))
                ->options([
                    'front.somoud.home' => __('Somoud Home'),
                ])
        ]);

        SkyPlugin::get()->itemType(__('Collection'), [
            Select::make('collection')
                ->searchable()
                ->options(function () {
                    return [
                        'event' => __('Events'),
                        'activity' => __('Activities'),
                        'administration' => __('Administrations'),
                        'hall' => __('Halls'),
                        'partners' => __('Partners'),
                        'product' => __('Products'),
                        'service' => __('Services'),
                        'supporters' => __('Supporters'),
                        'cource' => __('Cources'),
                        'initiative' => __('Initiatives'),
                        'blogs' => __('All News'),
                        'dashboard' => __('Library'),
                        'faq' => __('Faqs'),

                    ];
                })
        ], 'collection');


    } 
}