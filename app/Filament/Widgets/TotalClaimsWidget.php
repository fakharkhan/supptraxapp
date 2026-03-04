<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Claims\ClaimResource;
use App\Models\Claim;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalClaimsWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 1;

    protected ?string $heading = 'Total Claims';

    public function getStats(): array
    {
        $count = Claim::count();

        return [
            Stat::make('', $count)
                ->description('Claims')
                ->icon('heroicon-o-document-text')
                ->color('primary')
                ->url(ClaimResource::getUrl('index')),
        ];
    }
}
