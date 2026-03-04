<?php

namespace App\Filament\Resources\Claims\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ClaimsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('location.name')
                    ->label('Location')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('claimant')
                    ->label('Claimant')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('claim_date')
                    ->label('Claim date')
                    ->date()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('status.abbreviation')
                    ->label('Status')
                    ->badge()
                    ->color(fn (?string $state): string => match (strtolower($state ?? '')) {
                        'ss' => 'success',
                        'esti' => 'info',
                        'wsc' => 'primary',
                        'cbc' => 'danger',
                        'none' => 'gray',
                        'strn' => 'info',
                        default => 'gray',
                    })
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('insuranceCompany.name')
                    ->label('Insurance')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('adjuster.name')
                    ->label('Adjuster')
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('client')
                    ->label('Client')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status_id')
                    ->label('Status')
                    ->relationship('status', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('location_id')
                    ->label('Location')
                    ->relationship('location', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('insurance_company_id')
                    ->label('Insurance')
                    ->relationship('insuranceCompany', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('client')
                    ->label('Client')
                    ->options(fn () => \App\Models\Claim::query()
                        ->whereNotNull('client')
                        ->distinct()
                        ->pluck('client', 'client')
                        ->sort()
                        ->all()),
            ])
            ->defaultSort('claim_date', 'desc');
    }
}
