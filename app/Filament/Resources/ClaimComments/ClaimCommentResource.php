<?php

namespace App\Filament\Resources\ClaimComments;

use App\Filament\Resources\ClaimComments\Pages\ListClaimComments;
use App\Filament\Resources\ClaimComments\Tables\ClaimCommentsTable;
use App\Models\ClaimComment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ClaimCommentResource extends Resource
{
    protected static ?string $model = ClaimComment::class;

    protected static ?string $recordTitleAttribute = 'text';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    public static function getNavigationGroup(): ?string
    {
        return 'Claims';
    }

    public static function getModelLabel(): string
    {
        return 'Claim Comment';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Claim Comments';
    }

    public static function table(Table $table): Table
    {
        return ClaimCommentsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClaimComments::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
