<?php

namespace App\Filament\Organization\Widgets;

use App\Models\Claim;
use App\Models\Status;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class DashboardKpisWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected ?string $heading = null;

    protected function getColumns(): int|array|null
    {
        return ['@xl' => 5, '!@lg' => 5];
    }

    public function getStats(): array
    {
        $query = $this->getFilteredQuery();
        $closedStatusIds = Status::whereIn('abbreviation', ['SS', 'CBC'])->pluck('id');

        $newClaims = (clone $query)->where('created_at', '>=', now()->subDays(7))->count();
        $workingClaims = (clone $query)->whereNotIn('status_id', $closedStatusIds)->count();
        $closedClaims = (clone $query)->whereIn('status_id', $closedStatusIds)->count();
        $totalAmount = (clone $query)->whereIn('status_id', $closedStatusIds)->sum('settlement_amount') ?? 0;
        $closedCount = (clone $query)->whereIn('status_id', $closedStatusIds)->count();
        $avgAmount = $closedCount > 0 ? $totalAmount / $closedCount : 0;

        return [
            Stat::make('New claims', $newClaims)
                ->description('New claims')
                ->icon('heroicon-o-plus-circle')
                ->color('primary'),
            Stat::make('Currently working', $workingClaims)
                ->description('Currently working')
                ->icon('heroicon-o-arrow-path')
                ->color('info'),
            Stat::make('Closed claims', $closedClaims)
                ->description('Closed claims')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->url(\App\Filament\Resources\Claims\ClaimResource::getUrl('index', [], true, 'organization')),
            Stat::make('Total dollar amount', '$' . number_format($totalAmount, 2))
                ->description('Total dollar amount')
                ->icon('heroicon-o-currency-dollar')
                ->color('gray'),
            Stat::make('Average dollar amount', '$' . number_format($avgAmount, 2))
                ->description('Average dollar amount')
                ->icon('heroicon-o-chart-bar')
                ->color('gray'),
        ];
    }

    protected function getFilteredQuery(): Builder
    {
        $query = Claim::query();
        $filters = $this->pageFilters ?? [];

        if (! empty($filters['from'])) {
            $query->whereDate('claim_date', '>=', $filters['from']);
        }
        if (! empty($filters['to'])) {
            $query->whereDate('claim_date', '<=', $filters['to']);
        }
        if (! empty($filters['location_id'])) {
            $query->where('location_id', $filters['location_id']);
        }
        if (! empty($filters['member'])) {
            $query->where('claim_handler', $filters['member']);
        }

        return $query;
    }
}
