<?php

namespace App\Filament\Organization\Widgets;

use App\Models\Claim;
use App\Models\Status;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\Widget;

class AverageClosingTimeWidget extends Widget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 1;

    protected string $view = 'filament.organization.widgets.average-closing-time-widget';

    public function getAverageDays(): int
    {
        $closedStatusIds = Status::whereIn('abbreviation', ['SS', 'CBC'])->pluck('id');
        $query = Claim::query()
            ->whereIn('status_id', $closedStatusIds)
            ->whereNotNull('claim_date')
            ->whereNotNull('funding_date');

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

        $claims = $query->get();
        $totalDays = $claims->sum(fn ($c) => $c->claim_date && $c->funding_date ? $c->claim_date->diffInDays($c->funding_date) : 0);
        $count = $claims->filter(fn ($c) => $c->claim_date && $c->funding_date)->count();

        return $count > 0 ? (int) round($totalDays / $count) : 0;
    }
}
