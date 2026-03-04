<?php

namespace App\Filament\Resources\Adjusters\Pages;

use App\Filament\Resources\Adjusters\AdjusterResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdjusters extends ListRecords
{
    protected static string $resource = AdjusterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
