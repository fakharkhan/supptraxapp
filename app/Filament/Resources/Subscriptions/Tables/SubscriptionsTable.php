<?php

namespace App\Filament\Resources\Subscriptions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('organization.name')
                    ->label('Organization')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at_source')
                    ->label('Created')
                    ->date()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('subscription_start')
                    ->label('Start')
                    ->date()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('subscription_end')
                    ->label('End')
                    ->date()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('subscription_model')
                    ->label('Model')
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Active' => 'success',
                        'Trialing' => 'info',
                        'Inactive' => 'gray',
                        'Canceled' => 'danger',
                        'Unpaid' => 'warning',
                        default => 'gray',
                    })
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
                SelectFilter::make('subscription_model')
                    ->label('Model')
                    ->options([
                        'Monthly' => 'Monthly',
                        'Yearly' => 'Yearly',
                    ]),
                SelectFilter::make('organization_id')
                    ->label('Organization')
                    ->relationship('organization', 'name')
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
