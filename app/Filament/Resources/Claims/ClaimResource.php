<?php

namespace App\Filament\Resources\Claims;

use App\Filament\Resources\Claims\Pages\ListClaims;
use App\Filament\Resources\Claims\Tables\ClaimsTable;
use App\Models\Claim;
use App\Models\Location;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use function Filament\Support\original_request;

class ClaimResource extends Resource
{
    protected static ?string $model = Claim::class;

    protected static ?string $recordTitleAttribute = 'claimant';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    public static function getNavigationGroup(): ?string
    {
        if (Filament::getCurrentPanel()?->getId() === 'organization') {
            return 'My Organization';
        }

        return 'Claims';
    }

    public static function getNavigationSort(): ?int
    {
        return Filament::getCurrentPanel()?->getId() === 'organization' ? 1 : null;
    }

    /**
     * @return array<NavigationItem>
     */
    public static function getNavigationItems(): array
    {
        if (Filament::getCurrentPanel()?->getId() !== 'organization') {
            return parent::getNavigationItems();
        }

        $locations = Location::query()->orderBy('name')->pluck('name', 'id');
        $baseUrl = static::getUrl('index');

        $childItems = $locations->map(fn (string $name, int $id) => NavigationItem::make($name)
            ->url($baseUrl . '?' . http_build_query([
                'tableFilters' => ['location_id' => ['value' => $id]],
            ]))
        )->values()->all();

        $activeRoutePattern = static::getNavigationItemActiveRoutePattern();

        return [
            NavigationItem::make(static::getNavigationLabel())
                ->group(static::getNavigationGroup())
                ->icon(static::getNavigationIcon())
                ->activeIcon(static::getActiveNavigationIcon())
                ->isActiveWhen(fn (): bool => original_request()->routeIs($activeRoutePattern))
                ->badge(static::getNavigationBadge(), color: static::getNavigationBadgeColor())
                ->sort(static::getNavigationSort())
                ->url(static::getNavigationUrl())
                ->childItems($childItems),
        ];
    }

    public static function table(Table $table): Table
    {
        return ClaimsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClaims::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
