<?php

namespace App\Filament\Resources\Invoices\Tables;

use App\Models\Invoice;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InvoicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('organization.name')
                    ->label('Organization')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('invoice_number')
                    ->label('Invoice number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Paid' => 'success',
                        'Open' => 'warning',
                        default => 'gray',
                    })
                    ->sortable()
                    ->placeholder('—'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'Paid' => 'Paid',
                        'Open' => 'Open',
                    ]),
                Filter::make('date_range')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('date_from')
                            ->label('From date'),
                        \Filament\Forms\Components\DatePicker::make('date_to')
                            ->label('To date'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => $query
                        ->when($data['date_from'] ?? null, fn (Builder $q, $date): Builder => $q->whereDate('date', '>=', $date))
                        ->when($data['date_to'] ?? null, fn (Builder $q, $date): Builder => $q->whereDate('date', '<=', $date))),
            ])
            ->recordActions([
                Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (Invoice $record): ?string => filled($record->file_path) ? asset('storage/' . $record->file_path) : null)
                    ->openUrlInNewTab()
                    ->visible(fn (Invoice $record): bool => filled($record->file_path)),
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
