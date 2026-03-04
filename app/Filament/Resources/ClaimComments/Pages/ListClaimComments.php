<?php

namespace App\Filament\Resources\ClaimComments\Pages;

use App\Filament\Resources\ClaimComments\ClaimCommentResource;
use Filament\Resources\Pages\ListRecords;

class ListClaimComments extends ListRecords
{
    protected static string $resource = ClaimCommentResource::class;
}
