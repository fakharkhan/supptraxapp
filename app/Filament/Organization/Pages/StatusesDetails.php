<?php

namespace App\Filament\Organization\Pages;

use App\Filament\Resources\Claims\ClaimResource;
use App\Models\Status;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Pages\Page;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class StatusesDetails extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    protected string $view = 'filament.organization.pages.statuses-details';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $title = 'Statuses Details';

    protected static ?string $slug = 'statuses-details';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Status::query()
                    ->withCount('claims')
                    ->orderBy('sort_order')
            )
            ->paginated(false)
            ->columns([
                TextColumn::make('name')
                    ->label('Status Name')
                    ->color(fn (Status $record): string => self::statusTextColor($record->color)),
                TextColumn::make('claims_count')
                    ->label('Total')
                    ->alignEnd(),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Back')
                ->icon(Heroicon::OutlinedChevronLeft)
                ->link()
                ->url(ClaimResource::getUrl('index')),
        ];
    }

    public static function statusTextColor(string $color): string
    {
        return match (strtolower($color)) {
            'gray' => 'gray',
            'orange' => 'warning',
            'blue' => 'info',
            'green' => 'success',
            'purple' => 'info',
            'red' => 'danger',
            'yellow' => 'warning',
            'pink' => 'danger',
            'teal' => 'success',
            'light blue' => 'info',
            'light green' => 'success',
            default => 'gray',
        };
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
