<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ClaimComments\ClaimCommentResource;
use App\Models\ClaimComment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalClaimCommentsWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    protected ?string $heading = 'Total Claim Comments';

    public function getStats(): array
    {
        $count = ClaimComment::count();

        return [
            Stat::make('', $count)
                ->description('Claim Comments')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->color('primary')
                ->url(ClaimCommentResource::getUrl('index')),
        ];
    }
}
