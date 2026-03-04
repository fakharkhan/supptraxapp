<?php

namespace App\Filament\Resources\SalesRepresentatives\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;

class SalesRepresentativeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Sales representative')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('number_of_leads')
                            ->label('Number of leads')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                        TextInput::make('trial_period')
                            ->label('Trial period')
                            ->helperText('For example: 7 days, 14 days, 3 months, None')
                            ->maxLength(50),
                        TextInput::make('link')
                            ->label('Subscription link')
                            ->url()
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }
}
