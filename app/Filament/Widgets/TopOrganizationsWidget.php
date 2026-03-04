<?php

namespace App\Filament\Widgets;

use App\Models\Organization;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class TopOrganizationsWidget extends Widget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected string $view = 'filament.widgets.top-organizations-widget';

    protected ?string $heading = 'Top 3 Organizations';

    public function getViewData(): array
    {
        $organizations = Organization::query()
            ->withCount('invoices')
            ->orderByDesc('invoices_count')
            ->limit(3)
            ->get();

        return [
            'organizations' => $organizations,
        ];
    }
}
