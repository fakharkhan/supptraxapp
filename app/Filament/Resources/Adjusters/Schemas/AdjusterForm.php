<?php

namespace App\Filament\Resources\Adjusters\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AdjusterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Adjuster')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('company_name')
                            ->label('Company name')
                            ->maxLength(255),
                        Select::make('insurance_company_id')
                            ->label('Insurance company')
                            ->relationship('insuranceCompany', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone_number')
                            ->label('Phone number')
                            ->tel()
                            ->maxLength(50),
                    ])
                    ->columns(2),
            ]);
    }
}
