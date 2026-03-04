<?php

namespace App\Providers\Filament;

use App\Filament\Organization\Pages\Dashboard;
use App\Filament\Organization\Pages\Details;
use App\Filament\Organization\Pages\Statuses;
use App\Filament\Organization\Pages\Subscription;
use App\Filament\Organization\Pages\Users;
use App\Filament\Organization\Widgets\AverageClosingTimeWidget;
use App\Filament\Organization\Widgets\ClosedClaimsChartWidget;
use App\Filament\Organization\Widgets\ClosedClaimsLineChartWidget;
use App\Filament\Organization\Widgets\DashboardKpisWidget;
use App\Filament\Organization\Widgets\UntouchedClaimsWidget;
use App\Filament\Resources\Claims\ClaimResource;
use App\Filament\Resources\InsuranceCompanies\InsuranceCompanyResource;
use App\Filament\Resources\Locations\LocationResource;
use App\Models\Location;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class OrganizationPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('organization')
            ->path('organization')
            ->login()
            ->brandName('SUPPTRAX')
            ->brandLogo(asset('images/supptrax-logo.svg'))
            ->darkModeBrandLogo(asset('images/supptrax-logo-white.svg'))
            ->brandLogoHeight('1.25rem')
            ->defaultThemeMode(ThemeMode::Dark)
            ->sidebarWidth('280px')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->resources([
                \App\Filament\Resources\Organizations\OrganizationResource::class,
                InsuranceCompanyResource::class,
                LocationResource::class,
                ClaimResource::class,
            ])
            ->pages([
                Dashboard::class,
                Details::class,
                Users::class,
                Statuses::class,
                Subscription::class,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                $claimsUrl = ClaimResource::getUrl('index');
                $locationChildren = Location::query()
                    ->orderBy('name')
                    ->get()
                    ->map(fn (Location $location) => NavigationItem::make($location->name)
                        ->url($claimsUrl . '?' . http_build_query([
                            'tableFilters' => ['location_id' => ['value' => $location->id]],
                        ]))
                    )
                    ->all();

                return $builder
                    ->items([
                        ...Dashboard::getNavigationItems(),
                        ...InsuranceCompanyResource::getNavigationItems(),
                        ...LocationResource::getNavigationItems(),
                    ])
                    ->group(
                        NavigationGroup::make('My Organization')
                            ->collapsible()
                            ->collapsed()
                            ->items([
                                NavigationItem::make('Details')
                                    ->icon(Heroicon::OutlinedQueueList)
                                    ->url(Details::getUrl())
                                    ->isActiveWhen(fn () => request()->routeIs('filament.organization.pages.details'))
                                    ->sort(1),
                                NavigationItem::make('Users')
                                    ->icon(Heroicon::OutlinedUsers)
                                    ->url(Users::getUrl())
                                    ->isActiveWhen(fn () => request()->routeIs('filament.organization.pages.users'))
                                    ->sort(2),
                                NavigationItem::make('Statuses')
                                    ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                                    ->url(Statuses::getUrl())
                                    ->isActiveWhen(fn () => request()->routeIs('filament.organization.pages.statuses'))
                                    ->sort(3),
                                NavigationItem::make('Subscription')
                                    ->icon(Heroicon::OutlinedCreditCard)
                                    ->url(Subscription::getUrl())
                                    ->isActiveWhen(fn () => request()->routeIs('filament.organization.pages.subscription'))
                                    ->sort(4),
                            ]),
                    )
                    ->group(
                        NavigationGroup::make()
                            ->items([
                                NavigationItem::make('Claims')
                                    ->icon(Heroicon::OutlinedClipboardDocumentList)
                                    ->url($claimsUrl)
                                    ->isActiveWhen(fn () => request()->routeIs('filament.organization.resources.claims.*'))
                                    ->childItems($locationChildren),
                            ]),
                    )
                    ->group(
                        NavigationGroup::make()
                            ->items([
                                NavigationItem::make('Support')
                                    ->icon(Heroicon::OutlinedQuestionMarkCircle)
                                    ->url('#')
                                    ->sort(100),
                            ]),
                    );
            })
            ->discoverWidgets(in: app_path('Filament/Organization/Widgets'), for: 'App\Filament\Organization\Widgets')
            ->widgets([
                AccountWidget::class,
                DashboardKpisWidget::class,
                ClosedClaimsChartWidget::class,
                UntouchedClaimsWidget::class,
                ClosedClaimsLineChartWidget::class,
                AverageClosingTimeWidget::class,
            ])
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
