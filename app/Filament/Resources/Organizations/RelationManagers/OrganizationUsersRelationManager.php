<?php

namespace App\Filament\Resources\Organizations\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrganizationUsersRelationManager extends RelationManager
{
    protected static string $relationship = 'organizationUsers';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('user_email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->label('Type')
                    ->options([
                        'External User' => 'External User',
                        'Org Member' => 'Org Member',
                    ])
                    ->default('External User')
                    ->required(),
                Toggle::make('is_chaser')
                    ->label('Chaser'),
                Toggle::make('is_closer')
                    ->label('Closer'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user_name')
            ->columns([
                TextColumn::make('user_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user_email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->sortable(),
                CheckboxColumn::make('is_chaser')
                    ->label('Chaser')
                    ->alignCenter(),
                CheckboxColumn::make('is_closer')
                    ->label('Closer')
                    ->alignCenter(),
                TextColumn::make('claims_count')
                    ->label('Claims')
                    ->sortable()
                    ->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
