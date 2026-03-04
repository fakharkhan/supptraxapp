<?php

namespace App\Filament\Resources\Statuses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StatusForm
{
    private const COLOR_HEX = [
        'Gray' => '#6b7280',
        'Orange' => '#f97316',
        'Blue' => '#3b82f6',
        'Green' => '#22c55e',
        'Purple' => '#a855f7',
        'Red' => '#ef4444',
        'Yellow' => '#eab308',
        'Pink' => '#ec4899',
        'Light Green' => '#86efac',
        'Light Blue' => '#7dd3fc',
        'Teal' => '#14b8a6',
    ];

    public static function getColorOptions(): array
    {
        $options = [];
        foreach (self::COLOR_HEX as $name => $hex) {
            $options[$name] = sprintf(
                '<span class="inline-flex rounded-md px-2 py-0.5 text-xs font-medium" style="background-color:%s;color:#fff">%s</span>',
                $hex,
                $name,
            );
        }

        return $options;
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Status')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('abbreviation')
                            ->label('Abbreviation')
                            ->required()
                            ->maxLength(20),
                        Select::make('color')
                            ->label('Color')
                            ->options(self::getColorOptions())
                            ->allowHtml()
                            ->searchable()
                            ->nullable(),
                        TextInput::make('description')
                            ->label('Description')
                            ->maxLength(500),
                        TextInput::make('sort_order')
                            ->label('Sort order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ])
                    ->columns(2),
            ]);
    }
}
