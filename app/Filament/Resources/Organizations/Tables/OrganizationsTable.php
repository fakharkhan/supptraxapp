<?php

namespace App\Filament\Resources\Organizations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrganizationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Organization name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('salesRepresentative.name')
                    ->label('Sales person')
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Active' => 'success',
                        'Trialing' => 'warning',
                        'Inactive' => 'warning',
                        'Canceled' => 'gray',
                        'Unpaid' => 'gray',
                        default => 'gray',
                    })
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('date_of_registration')
                    ->label('Date of registration')
                    ->date()
                    ->sortable()
                    ->placeholder('—'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'Active' => 'Active',
                        'Inactive' => 'Inactive',
                        'Trialing' => 'Trialing',
                        'Canceled' => 'Canceled',
                        'Unpaid' => 'Unpaid',
                    ]),
                SelectFilter::make('sales_representative_id')
                    ->label('Sales person')
                    ->relationship('salesRepresentative', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
