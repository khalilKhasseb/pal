<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Navigation\NavigationGroup;

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use LaraZeus\Sky\SkyPlugin;
use Filament\Navigation\MenuItem;
use Filament\Facades\Filament;
use App\Classes\ExtraNavFields;
use Google\Service\CloudSearch\Menu;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

        return $panel
            ->default()
            ->id('admin')
            ->path('admin') // where you change url of tha panel path making the app being accessiable without any prefix leave it emptyl ex: path('');
            ->login()
            ->colors([
                'primary' => Color::Green,
            ])
            ->favicon(asset('fv/favicon.ico'))
            ->brandLogo(asset('brandLogo.jpg'))
            ->font('Zain')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->brandName('Nebula Systems')
            ->discoverResources(in: app_path('Filament/Sommod/Resources'), for: 'App\\Filament\\Sommod\\Resources')
            ->discoverResources(in: app_path('Filament//Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverPages(in: app_path('Filament/Sommod/Pages'), for: 'App\\Filament\\Sommod\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                //    Widgets\FilamentInfoWidget::class,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label(__('Somoud'))
                    ->url(fn() => route('filament.somoud.pages.dashboard')),
                MenuItem::make('all_content')
                    ->label(function (): string {

                        if (session()->has('show_all_content')) {
                            $show =  session('show_all_content');

                            if ($show) {
                                return __('Disable All Content');
                            }

                            return __('Enable All Content');
                        }
                        return __('Enable All Content');
                    })
                    ->url(fn() => route('admin.all_content')),
            ])->navigationGroups([
                __('Blog'),
                __('Theme content'),
                __('Users'),
                __('Settings'),
            ])
            ->databaseNotifications()

            ->authGuard('system')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \App\Http\Middleware\Sommod::class

            ])
            ->authMiddleware([
                Authenticate::class,
            ])->plugins([

                SpatieLaravelTranslatablePlugin::make()->defaultLocales(['ar', 'en']),
                SkyPlugin::make()
                    ->navigationGroupLabel(__('Blog'))
                    ->tagTypes([
                        'tag' => 'Tag',
                        'category' => 'Category',
                        'library' => 'Library',
                        'faq' => 'Faq',
                        'product' => 'Product',
                        'service' => 'Service',
                        'hall' => 'Hall',
                        'activity' => 'Activity',
                        'administration' => 'Administration',
                        'partner' => 'Partner',
                        'gallary' => 'Gallary',
                        'expert' => 'Expert',
                    ]),
                \TomatoPHP\FilamentMediaManager\FilamentMediaManagerPlugin::make(),

            ])->bootUsing(function ($panel) {
                ExtraNavFields::initFields();
            })
            ->default()
        ;
    }
}
