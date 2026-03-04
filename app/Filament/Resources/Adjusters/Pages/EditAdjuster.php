<?php

namespace App\Filament\Resources\Adjusters\Pages;

use App\Filament\Resources\Adjusters\AdjusterResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAdjuster extends EditRecord
{
    protected static string $resource = AdjusterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
