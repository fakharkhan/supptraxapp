<?php

namespace App\Filament\Widgets;

use App\Models\Organization;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalOrganizationsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 1;

    protected ?string $heading = 'Total Organizations';

    public function getStats(): array
    {
        $count = Organization::count();

        return [
            Stat::make('', $count)
                ->description('Organizations')
                ->icon('heroicon-o-building-office-2')
                ->color('primary')
                ->url(\App\Filament\Resources\Organizations\OrganizationResource::getUrl('index')),
        ];
    }
}
