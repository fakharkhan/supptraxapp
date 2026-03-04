<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Subscription')
                    ->schema([
                        Select::make('organization_id')
                            ->label('Organization')
                            ->relationship('organization', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        DatePicker::make('created_at_source')
                            ->label('Created')
                            ->nullable(),
                        DatePicker::make('subscription_start')
                            ->label('Subscription start')
                            ->nullable(),
                        DatePicker::make('subscription_end')
                            ->label('Subscription end')
                            ->nullable(),
                        Select::make('subscription_model')
                            ->label('Model')
                            ->options([
                                'Monthly' => 'Monthly',
                                'Yearly' => 'Yearly',
                            ])
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
                    ])
                    ->columns(2),
            ]);
    }
}
