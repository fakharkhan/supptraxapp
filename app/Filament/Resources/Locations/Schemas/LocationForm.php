<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Location')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('total_claims')
                            ->label('Total claims')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                        Toggle::make('show_board')
                            ->label('Show board')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
