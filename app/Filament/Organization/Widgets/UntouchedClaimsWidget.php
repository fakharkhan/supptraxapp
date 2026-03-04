<?php

namespace App\Filament\Organization\Widgets;

use App\Filament\Resources\Claims\ClaimResource;
use App\Models\Claim;
use App\Models\Status;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class UntouchedClaimsWidget extends Widget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected string $view = 'filament.organization.widgets.untouched-claims-widget';

    public function getClaims(): Collection
    {
        $query = Claim::query()
            ->where('updated_at', '<=', now()->subHours(48))
            ->with(['status'])
            ->latest('updated_at')
            ->limit(5);

        $filters = $this->pageFilters ?? [];
        if (! empty($filters['location_id'])) {
            $query->where('location_id', $filters['location_id']);
        }
        if (! empty($filters['member'])) {
            $query->where('claim_handler', $filters['member']);
        }

        return $query->get();
    }

    public function getViewAllUrl(): string
    {
        return ClaimResource::getUrl('index', [], true, 'organization');
    }

    public function getStatusColor(string $statusName): string
    {
        $name = strtolower($statusName);

        if (str_contains($name, 'cancelled') || str_contains($name, 'cancel')) {
            return 'text-amber-500';
        }
        if (str_contains($name, 'retrieve') || str_contains($name, 'final')) {
            return 'text-emerald-500';
        }

        return 'text-gray-400';
    }
}
