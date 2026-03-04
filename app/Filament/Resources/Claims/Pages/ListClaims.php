<?php

namespace App\Filament\Resources\Claims\Pages;

use App\Filament\Resources\Claims\ClaimResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListClaims extends ListRecords
{
    protected static string $resource = ClaimResource::class;

    protected ?string $heading = 'Board';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('statusesDetails')
                ->label('Statuses Details')
                ->link()
                ->color('primary')
                ->url(route('filament.organization.pages.statuses-details')),

            Action::make('createClaim')
                ->label('Create claim')
                ->url(ClaimResource::getUrl('create'))
                ->icon(Heroicon::OutlinedPlus),
        ];
    }
}
