<?php

namespace App\Filament\Organization\Pages;

use App\Models\Claim;
use App\Models\Location;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    protected static string $routePath = 'dashboard';

    protected static ?int $navigationSort = -2;

    public function getFiltersFormContentComponent(): \Filament\Schemas\Components\Component
    {
        return EmbeddedSchema::make('filtersForm')
            ->columnSpanFull();
    }

    public function filtersForm(Schema $schema): Schema
    {
        $members = Claim::query()
            ->whereNotNull('claim_handler')
            ->distinct()
            ->orderBy('claim_handler')
            ->pluck('claim_handler', 'claim_handler')
            ->all();

        return $schema
            ->components([
                Section::make()
                    ->schema([
                        DatePicker::make('from')
                            ->label('From')
                            ->hiddenLabel()
                            ->native(false)
                            ->placeholder('From')
                            ->prefixIcon('heroicon-o-calendar')
                            ->columnSpan(1),
                        DatePicker::make('to')
                            ->label('To')
                            ->hiddenLabel()
                            ->native(false)
                            ->placeholder('To')
                            ->prefixIcon('heroicon-o-calendar')
                            ->columnSpan(1),
                        Select::make('member')
                            ->label('All members')
                            ->hiddenLabel()
                            ->options($members)
                            ->placeholder('All members')
                            ->columnSpan(1),
                        Select::make('location_id')
                            ->label('All locations')
                            ->hiddenLabel()
                            ->options(Location::query()->pluck('name', 'id'))
                            ->placeholder('All locations')
                            ->columnSpan(1),
                    ])
                    ->columns(4)
                    ->columnSpanFull()
                    ->footerActions([
                        Action::make('clearFilters')
                            ->label('Clear filters')
                            ->color('gray')
                            ->action(fn () => $this->resetFilters())
                            ->link(),
                        Action::make('filter')
                            ->label('Filter')
                            ->color('primary')
                            ->action(fn () => $this->dispatch('$refresh')),
                    ])
                    ->footerActionsAlignment(\Filament\Support\Enums\Alignment::End)
                    ->contained(),
            ]);
    }

    public function resetFilters(): void
    {
        $this->filters = [];
        $this->getFiltersForm()->fill([]);
        if ($this->persistsFiltersInSession()) {
            session()->put($this->getFiltersSessionKey(), []);
        }
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Organization\Widgets\DashboardKpisWidget::class,
            \App\Filament\Organization\Widgets\ClosedClaimsChartWidget::class,
            \App\Filament\Organization\Widgets\UntouchedClaimsWidget::class,
            \App\Filament\Organization\Widgets\ClosedClaimsLineChartWidget::class,
            \App\Filament\Organization\Widgets\AverageClosingTimeWidget::class,
        ];
    }

    public function getColumns(): int | array
    {
        return [
            'default' => 1,
            'lg' => 2,
        ];
    }
}
