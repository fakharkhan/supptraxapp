<?php

namespace App\Filament\Resources\SalesRepresentatives;

use App\Filament\Resources\SalesRepresentatives\Pages\CreateSalesRepresentative;
use App\Filament\Resources\SalesRepresentatives\Pages\EditSalesRepresentative;
use App\Filament\Resources\SalesRepresentatives\Pages\ListSalesRepresentatives;
use App\Filament\Resources\SalesRepresentatives\Schemas\SalesRepresentativeForm;
use App\Filament\Resources\SalesRepresentatives\Tables\SalesRepresentativesTable;
use App\Models\SalesRepresentative;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SalesRepresentativeResource extends Resource
{
    protected static ?string $model = SalesRepresentative::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SalesRepresentativeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SalesRepresentativesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSalesRepresentatives::route('/'),
            'create' => CreateSalesRepresentative::route('/create'),
            'edit' => EditSalesRepresentative::route('/{record}/edit'),
        ];
    }
}
