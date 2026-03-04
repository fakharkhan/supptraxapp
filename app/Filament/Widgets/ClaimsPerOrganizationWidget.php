<?php

namespace App\Filament\Widgets;

use App\Models\Organization;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ClaimsPerOrganizationWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Claims per organization';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Organization::query()
                    ->withCount('invoices')
                    ->orderByDesc('invoices_count')
            )
            ->columns([
                TextColumn::make('invoices_count')
                    ->label('Claims')
                    ->formatStateUsing(fn (int $state): string => "{$state} Claims")
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Organization')
                    ->searchable(),
            ])
            ->headerActions([
                Action::make('viewAll')
                    ->label('View all')
                    ->url(\App\Filament\Resources\Organizations\OrganizationResource::getUrl('index')),
            ])
            ->recordActions([
                Action::make('manage')
                    ->label('Manage')
                    ->url(fn (Organization $record): string => \App\Filament\Resources\Organizations\OrganizationResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated([10]);
    }
}
