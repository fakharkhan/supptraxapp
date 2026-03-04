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

    public function mount(): void
    {
        parent::mount();

        if (request()->routeIs('filament.organization.resources.claims.board')) {
            $location = request()->route('location');
            if ($location !== null) {
                $this->tableFilters = array_merge($this->tableFilters ?? [], [
                    'location_id' => ['value' => (int) $location],
                ]);
            }
        }
    }

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
