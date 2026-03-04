<?php

namespace App\Filament\Resources\ClaimComments\Tables;

use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClaimCommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('board.board_id')
                    ->label('Board')
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('page')
                    ->label('Page')
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('index')
                    ->label('Index')
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('author')
                    ->label('Author')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('text')
                    ->label('Text')
                    ->limit(80)
                    ->searchable()
                    ->wrap(),
                TextColumn::make('commented_at')
                    ->label('Timestamp')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('—'),
            ])
            ->filters([
                SelectFilter::make('board_id')
                    ->label('Board')
                    ->relationship('board', 'name', fn ($q) => $q->orderBy('board_id'))
                    ->getOptionLabelFromRecordUsing(fn ($record) => "Board {$record->board_id}"),
                SelectFilter::make('author')
                    ->label('Author')
                    ->options(fn () => \App\Models\ClaimComment::query()
                        ->whereNotNull('author')
                        ->distinct()
                        ->pluck('author', 'author')
                        ->sort()
                        ->all()),
                Filter::make('commented_at')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')
                            ->label('From date'),
                        \Filament\Forms\Components\DatePicker::make('until')
                            ->label('Until date'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => $query
                        ->when($data['from'] ?? null, fn (Builder $q, $date): Builder => $q->whereDate('commented_at', '>=', $date))
                        ->when($data['until'] ?? null, fn (Builder $q, $date): Builder => $q->whereDate('commented_at', '<=', $date))),
            ])
            ->recordActions([
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->modalHeading(fn ($record) => 'Comment by ' . ($record->author ?? 'Unknown'))
                    ->modalContent(fn ($record) => view('filament.resources.claim-comments.view-modal', ['record' => $record]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close'),
            ])
            ->defaultSort('commented_at', 'desc')
            ->paginated([10, 25, 50]);
    }
}
