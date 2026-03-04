<?php

namespace App\Filament\Resources\Adjusters;

use App\Filament\Resources\Adjusters\Pages\CreateAdjuster;
use App\Filament\Resources\Adjusters\Pages\EditAdjuster;
use App\Filament\Resources\Adjusters\Pages\ListAdjusters;
use App\Filament\Resources\Adjusters\Schemas\AdjusterForm;
use App\Filament\Resources\Adjusters\Tables\AdjustersTable;
use App\Models\Adjuster;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdjusterResource extends Resource
{
    protected static ?string $model = Adjuster::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    public static function getNavigationGroup(): ?string
    {
        return 'Reference Data';
    }

    public static function form(Schema $schema): Schema
    {
        return AdjusterForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdjustersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdjusters::route('/'),
            'create' => CreateAdjuster::route('/create'),
            'edit' => EditAdjuster::route('/{record}/edit'),
        ];
    }
}
