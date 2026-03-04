<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Invoice')
                    ->schema([
                        Select::make('organization_id')
                            ->label('Organization')
                            ->relationship('organization', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('invoice_number')
                            ->label('Invoice number')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('date')
                            ->label('Date')
                            ->required(),
                        TextInput::make('amount')
                            ->label('Amount')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->step(0.01),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'Paid' => 'Paid',
                                'Open' => 'Open',
                            ])
                            ->nullable(),
                        TextInput::make('file_path')
                            ->label('File path')
                            ->maxLength(255)
                            ->placeholder('Path to invoice file'),
                    ])
                    ->columns(2),
            ]);
    }
}
