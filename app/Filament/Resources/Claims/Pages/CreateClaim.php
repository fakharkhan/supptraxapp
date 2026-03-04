<?php

namespace App\Filament\Resources\Claims\Pages;

use App\Filament\Resources\Claims\ClaimResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClaim extends CreateRecord
{
    protected static string $resource = ClaimResource::class;

    protected ?string $heading = 'Create Claim';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['location_id'])) {
            $data['location_id'] = \App\Models\Location::first()?->id;
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()
            ->requiresConfirmation()
            ->modalHeading('Are you sure you want to cancel?')
            ->modalDescription('This cannot be undone and details can not be saved.')
            ->modalSubmitActionLabel('Yes')
            ->modalCancelActionLabel('No')
            ->color('danger');
    }
}
