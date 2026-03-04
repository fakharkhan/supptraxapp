<?php

namespace App\Filament\Organization\Pages;

use App\Models\Status;
use BackedEnum;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Pages\Page;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Statuses extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    protected string $view = 'filament.organization.pages.statuses';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAdjustmentsHorizontal;

    protected static ?string $title = 'Manage Statuses';

    protected static ?int $navigationSort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(Status::query()->orderBy('sort_order'))
            ->paginated(false)
            ->columns([
                TextInputColumn::make('name')
                    ->label('Status Name')
                    ->rules(['required', 'max:255']),
                TextInputColumn::make('abbreviation')
                    ->label('Abbreviation')
                    ->rules(['required', 'max:20']),
                ColorColumn::make('color_hex')
                    ->label('Status Color')
                    ->state(fn (Status $record): string => self::colorNameToHex($record->color))
                    ->width(30),
                SelectColumn::make('color')
                    ->label('')
                    ->options([
                        'Gray' => 'Gray',
                        'Orange' => 'Orange',
                        'Blue' => 'Blue',
                        'Green' => 'Green',
                        'Purple' => 'Purple',
                        'Red' => 'Red',
                        'Yellow' => 'Yellow',
                        'Pink' => 'Pink',
                        'Teal' => 'Teal',
                        'Light Blue' => 'Light Blue',
                        'Light Green' => 'Light Green',
                    ]),
                TextColumn::make('description')
                    ->label('Status Description')
                    ->limit(50)
                    ->placeholder('—'),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('View')
                    ->modalHeading('View Status Description')
                    ->modalWidth('md')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->infolist([
                        TextEntry::make('description')
                            ->hiddenLabel(),
                    ]),
            ]);
    }

    public static function colorNameToHex(string $name): string
    {
        return match (strtolower($name)) {
            'gray' => '#9ca3af',
            'orange' => '#f59e0b',
            'blue' => '#3b82f6',
            'green' => '#22c55e',
            'purple' => '#a855f7',
            'red' => '#ef4444',
            'yellow' => '#eab308',
            'pink' => '#ec4899',
            'teal' => '#14b8a6',
            'light blue' => '#38bdf8',
            'light green' => '#4ade80',
            default => '#6b7280',
        };
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
