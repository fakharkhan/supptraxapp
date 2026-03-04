<?php

namespace App\Filament\Organization\Widgets;

use App\Models\Claim;
use App\Models\Status;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ClosedClaimsLineChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    protected ?string $maxHeight = '150px';

    protected function getType(): string
    {
        return 'line';
    }

    public function getHeading(): string | Htmlable | null
    {
        $counts = $this->getMonthlyCounts();

        return new HtmlString(
            view('filament.organization.widgets.closed-claims-line-heading', [
                'lastMonthCount' => $counts['last'],
                'thisMonthCount' => $counts['this'],
            ])->render()
        );
    }

    protected function getData(): array
    {
        $closedStatusIds = Status::whereIn('abbreviation', ['SS', 'CBC'])->pluck('id');
        $filters = $this->pageFilters ?? [];

        $labels = [];
        $data = [];
        $current = now()->subMonths(5)->startOfMonth();
        $end = now()->endOfMonth();

        while ($current <= $end) {
            $labels[] = $current->format('M');
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
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                    'pointRadius' => 0,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => ['display' => false],
            ],
            'scales' => [
                'x' => ['display' => false],
                'y' => ['display' => false],
            ],
        ];
    }

    protected function getMonthlyCounts(): array
    {
        $closedStatusIds = Status::whereIn('abbreviation', ['SS', 'CBC'])->pluck('id');
        $filters = $this->pageFilters ?? [];

        $lastMonth = now()->subMonth();
        $thisMonth = now();

        $lastCount = Claim::query()
            ->whereIn('status_id', $closedStatusIds)
            ->whereDate('claim_date', '>=', $lastMonth->copy()->startOfMonth())
            ->whereDate('claim_date', '<=', $lastMonth->copy()->endOfMonth())
            ->when(! empty($filters['location_id']), fn ($q) => $q->where('location_id', $filters['location_id']))
            ->when(! empty($filters['member']), fn ($q) => $q->where('claim_handler', $filters['member']))
            ->count();

        $thisCount = Claim::query()
            ->whereIn('status_id', $closedStatusIds)
            ->whereDate('claim_date', '>=', $thisMonth->copy()->startOfMonth())
            ->whereDate('claim_date', '<=', $thisMonth->copy()->endOfMonth())
            ->when(! empty($filters['location_id']), fn ($q) => $q->where('location_id', $filters['location_id']))
            ->when(! empty($filters['member']), fn ($q) => $q->where('claim_handler', $filters['member']))
            ->count();

        return ['last' => $lastCount, 'this' => $thisCount];
    }
}
