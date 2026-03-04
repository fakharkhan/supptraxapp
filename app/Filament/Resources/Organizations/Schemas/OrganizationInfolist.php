<?php

namespace App\Filament\Resources\Organizations\Schemas;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrganizationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Organization')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Organization name'),
                        TextEntry::make('salesRepresentative.name')
                            ->label('Sales person')
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
                        TextEntry::make('date_of_registration')
                            ->label('Date of registration')
                            ->date()
                            ->placeholder('—'),
                    ])
                    ->columns(2),
                Section::make('Contact')
                    ->schema([
                        TextEntry::make('contact_full_name')
                            ->label('Full name')
                            ->placeholder('—'),
                        TextEntry::make('contact_phone')
                            ->label('Phone')
                            ->placeholder('—'),
                        TextEntry::make('contact_email')
                            ->label('Email')
                            ->placeholder('—'),
                    ])
                    ->columns(3)
                    ->collapsible(),
            ]);
    }
}
