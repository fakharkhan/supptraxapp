<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SubscriptionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Subscription')
                    ->schema([
                        TextEntry::make('organization.name')
                            ->label('Organization'),
                        TextEntry::make('created_at_source')
                            ->label('Created')
                            ->date()
                            ->placeholder('—'),
                        TextEntry::make('subscription_start')
                            ->label('Subscription start')
                            ->date()
                            ->placeholder('—'),
                        TextEntry::make('subscription_end')
                            ->label('Subscription end')
                            ->date()
                            ->placeholder('—'),
                        TextEntry::make('subscription_model')
                            ->label('Model')
                            ->placeholder('—'),
                        TextEntry::make('status')
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
                            ->placeholder('—'),
                    ])
                    ->columns(2),
            ]);
    }
}
