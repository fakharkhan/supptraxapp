<?php

namespace App\Filament\Organization\Widgets;

use App\Models\Claim;
use App\Models\Status;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class ClosedClaimsChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 1;

    protected ?string $heading = 'Closed claims';

    protected ?string $maxHeight = '300px';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $closedStatusIds = Status::whereIn('abbreviation', ['SS', 'CBC'])->pluck('id');
        $filters = $this->pageFilters ?? [];
        $from = ! empty($filters['from']) ? Carbon::parse($filters['from']) : now()->subMonths(5)->startOfMonth();
        $to = ! empty($filters['to']) ? Carbon::parse($filters['to']) : now()->endOfMonth();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $labels = [];
        $data = [];
        $current = $from->copy()->startOfMonth();

        while ($current <= $to) {
            $labels[] = $months[$current->month - 1];
            $count = Claim::query()
                ->whereIn('status_id', $closedStatusIds)
                ->whereDate('claim_date', '>=', $current->copy()->startOfMonth())
                ->whereDate('claim_date', '<=', $current->copy()->endOfMonth())
                ->when(! empty($filters['location_id']), fn ($q) => $q->where('location_id', $filters['location_id']))
                ->when(! empty($filters['member']), fn ($q) => $q->where('claim_handler', $filters['member']))
                ->count();
            $data[] = $count;
            $current->addMonth();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Closed claims',
                    'data' => $data,
                    'backgroundColor' => 'rgb(245, 158, 11)',
                    'borderColor' => 'rgb(245, 158, 11)',
                ],
            ],
            'labels' => $labels,
        ];
    }
}
