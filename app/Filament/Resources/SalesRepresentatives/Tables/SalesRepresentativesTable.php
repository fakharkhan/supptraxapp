<?php

namespace App\Filament\Resources\SalesRepresentatives\Tables;

use App\Models\SalesRepresentative;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SalesRepresentativesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('number_of_leads')
                    ->label('Leads')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('trial_period')
                    ->label('Trial period')
                    ->sortable(),
                TextColumn::make('link')
                    ->label('Link')
                    ->url()
                    ->openUrlInNewTab()
                    ->limit(40),
            ])
            ->filters([
                SelectFilter::make('trial_period')
                    ->label('Trial period')
                    ->options(
                        SalesRepresentative::query()
                            ->whereNotNull('trial_period')
                            ->distinct()
                            ->pluck('trial_period', 'trial_period')
                            ->filter()
                            ->all(),
                    ),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
