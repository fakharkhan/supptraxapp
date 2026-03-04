<?php

namespace App\Filament\Resources\Organizations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrganizationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Organization')
                    ->schema([
                        TextInput::make('name')
                            ->label('Organization name')
                            ->required()
                            ->maxLength(255),
                        Select::make('sales_representative_id')
                            ->label('Sales person')
                            ->relationship('salesRepresentative', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'Active' => 'Active',
                                'Inactive' => 'Inactive',
                                'Trialing' => 'Trialing',
                                'Canceled' => 'Canceled',
                                'Unpaid' => 'Unpaid',
                            ])
                            ->nullable(),
                        DatePicker::make('date_of_registration')
                            ->label('Date of registration')
                            ->nullable(),
                    ])
                    ->columns(2),
                Section::make('Organization address')
                    ->schema([
                        TextInput::make('organization_address')
                            ->label('Address')
                            ->maxLength(255),
                        TextInput::make('organization_zip')
                            ->label('Zip')
                            ->maxLength(20),
                        TextInput::make('organization_state')
                            ->label('State')
                            ->maxLength(100),
                    ])
                    ->columns(3)
                    ->collapsible(),
                Section::make('Billing address')
                    ->schema([
                        TextInput::make('billing_address')
                            ->label('Address')
                            ->maxLength(255),
                        TextInput::make('billing_zip')
                            ->label('Zip')
                            ->maxLength(20),
                        TextInput::make('billing_state')
                            ->label('State')
                            ->maxLength(100),
                    ])
                    ->columns(3)
                    ->collapsible(),
                Section::make('Contact')
                    ->schema([
                        TextInput::make('contact_full_name')
                            ->label('Full name')
                            ->maxLength(255),
                        TextInput::make('contact_phone')
                            ->label('Phone')
                            ->tel()
                            ->maxLength(50),
                        TextInput::make('contact_email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                    ])
                    ->columns(3)
                    ->collapsible(),
            ]);
    }
}
