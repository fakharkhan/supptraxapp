<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InvoiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Invoice')
                    ->schema([
                        TextEntry::make('organization.name')
                            ->label('Organization'),
                        TextEntry::make('invoice_number')
                            ->label('Invoice number'),
                        TextEntry::make('date')
                            ->label('Date')
                            ->date(),
                        TextEntry::make('amount')
                            ->label('Amount')
                            ->money('USD'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (?string $state): string => match ($state) {
                                'Paid' => 'success',
                                'Open' => 'warning',
                                default => 'gray',
                            })
                            ->placeholder('—'),
                        TextEntry::make('file_path')
                            ->label('File path')
                            ->placeholder('—'),
                    ])
                    ->columns(2),
            ]);
    }
}
