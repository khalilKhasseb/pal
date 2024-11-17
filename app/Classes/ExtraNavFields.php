<?php
namespace App\Classes;
use Filament\Forms\Components\Select;
use LaraZeus\Sky\SkyPlugin;

class ExtraNavFields
{
    /**
     * Initializes the extra navigation fields.
     */
    public static function initFields(): void
    {
        // Add a field to the navigation item to select the category
        SkyPlugin::get()->itemType(__('Category'), [
            Select::make('category_id')
                ->searchable()
                ->label(__('Category'))
                ->options(function () {
                    // Return a list of categories with their names and IDs
                    return SkyPlugin::get()->getModel('Tag')::whereIn('type', SkyPlugin::get()->getModel('Tag')::getTypes())->pluck('name', 'id')->map(fn($tag) => preg_replace('/\n/', '', $tag));
                })
        ], 'category');

        // Add a field to the navigation item to select the sommod route
        SkyPlugin::get()->itemType(__('Sommod Routes'), [
            Select::make('sommod_routes')
                ->label(__('Sommod Routes'))
                ->options([
                    // Add the routes for the sommod
                    'front.somoud.home' => __('Somoud Home'),
                ])
        ]);

        // Add a field to the navigation item to select the collection
        SkyPlugin::get()->itemType(__('Collection'), [
            Select::make('collection')
                ->searchable()
                ->label(__('Collection'))
                ->options(function () {
                    // Return a list of collections with their names and IDs
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
                        'experts' => __('Experts'),
                    ];
                })
        ], 'collection');

    }
}