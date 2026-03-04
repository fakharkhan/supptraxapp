<?php

namespace App\Filament\Resources\Statuses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatusesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('abbreviation')
                    ->label('Abbreviation')
                    ->badge()
                    ->sortable(),
                TextColumn::make('color')
                    ->label('Color')
                    ->badge()
                    ->color(fn (?string $state): string => match (strtolower($state ?? '')) {
                        'gray' => 'gray',
                        'orange' => 'warning',
                        'blue', 'light blue', 'teal' => 'info',
                        'green', 'light green' => 'success',
                        'purple' => 'primary',
                        'red', 'pink' => 'danger',
                        'yellow' => 'warning',
                        default => 'gray',
                    })
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(40)
                    ->placeholder('—'),
                TextColumn::make('sort_order')
                    ->label('Sort')
                    ->sortable()
                    ->placeholder('—'),
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
