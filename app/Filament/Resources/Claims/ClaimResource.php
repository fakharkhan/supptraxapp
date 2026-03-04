<?php

namespace App\Filament\Resources\Claims;

use App\Filament\Resources\Claims\Pages\ListClaims;
use App\Filament\Resources\Claims\Tables\ClaimsTable;
use App\Models\Claim;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ClaimResource extends Resource
{
    protected static ?string $model = Claim::class;

    protected static ?string $recordTitleAttribute = 'claimant';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    public static function getNavigationGroup(): ?string
    {
        return 'Claims';
    }

    public static function table(Table $table): Table
    {
        return ClaimsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClaims::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
