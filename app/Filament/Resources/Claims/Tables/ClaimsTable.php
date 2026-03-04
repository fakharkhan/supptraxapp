<?php

namespace App\Filament\Resources\Claims\Tables;

use App\Filament\Organization\Pages\Statuses;
use App\Models\Claim;
use App\Models\OrganizationUser;
use App\Models\Status;
use Filament\Actions\StaticAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Notifications\Notification;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Enums\FiltersResetActionPosition;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ClaimsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('claimant')
                    ->label('Claimant')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('claim_date')
                    ->label('Date')
                    ->formatStateUsing(function (Claim $record): string {
                        $cd = $record->claim_date?->format('M d, Y') ?? '—';
                        $sd = $record->submission_date?->format('M d, Y') ?? '—';
                        $fd = $record->funding_date?->format('M d, Y') ?? '—';

                        return "CD: {$cd}<br>SD: {$sd}<br>FD: {$fd}";
                    })
                    ->html()
                    ->wrap()
                    ->sortable()
                    ->placeholder('—')
                    ->extraAttributes(fn (Claim $record): array => [
                        'title' => 'Claim: ' . ($record->claim_date?->format('M d, Y') ?? '—')
                            . ' | Submission: ' . ($record->submission_date?->format('M d, Y') ?? '—')
                            . ' | Funding: ' . ($record->funding_date?->format('M d, Y') ?? '—'),
                    ]),
                TextColumn::make('status.abbreviation')
                    ->label('Status')
                    ->badge()
                    ->color(fn (?string $state): string => self::statusColor($state))
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('insuranceCompany.name')
                    ->label('Insurance')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('adjuster.name')
                    ->label('Adjuster')
                    ->description(fn (Claim $record): ?string => $record->adjuster?->phone_number)
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('claim_handler')
                    ->label('Groups')
                    ->formatStateUsing(function (Claim $record): string {
                        $ch = $record->claim_handler ?: 'N/A';
                        $cl = $record->client ?: 'N/A';

                        return "CH: {$ch}\nCL: {$cl}";
                    })
                    ->placeholder('—'),
            ])
            ->filters(
                [
                    Filter::make('claim_date')
                        ->schema([
                            DatePicker::make('created_from')
                                ->label('Select created date')
                                ->placeholder('From'),
                            DatePicker::make('created_until')
                                ->label('')
                                ->placeholder('To'),
                        ])
                        ->query(fn (Builder $query, array $data): Builder => $query
                            ->when($data['created_from'] ?? null, fn (Builder $q, $date): Builder => $q->whereDate('claim_date', '>=', $date))
                            ->when($data['created_until'] ?? null, fn (Builder $q, $date): Builder => $q->whereDate('claim_date', '<=', $date))),
                    Filter::make('follow_up_date')
                        ->schema([
                            DatePicker::make('follow_up_from')
                                ->label('Select follow-up date')
                                ->placeholder('From'),
                            DatePicker::make('follow_up_until')
                                ->label('')
                                ->placeholder('To'),
                        ])
                        ->query(function (Builder $query, array $data): Builder {
                            $from = $data['follow_up_from'] ?? null;
                            $until = $data['follow_up_until'] ?? null;
                            if (!$from && !$until) {
                                return $query;
                            }
                            return $query->whereHas('followUps', function (Builder $b) use ($from, $until): void {
                                if ($from) {
                                    $b->whereDate('follow_up_date', '>=', $from);
                                }
                                if ($until) {
                                    $b->whereDate('follow_up_date', '<=', $until);
                                }
                            });
                        }),
                    SelectFilter::make('location_id')
                        ->label('Location')
                        ->relationship('location', 'name')
                        ->searchable()
                        ->preload()
                        ->placeholder('Select location'),
                    SelectFilter::make('status_id')
                        ->label('Status')
                        ->relationship('status', 'name')
                        ->searchable()
                        ->preload()
                        ->placeholder('Select status'),
                    SelectFilter::make('priority')
                        ->label('Priority')
                        ->options([
                            'Low' => 'Low',
                            'Medium' => 'Medium',
                            'High' => 'High',
                            'Urgent' => 'Urgent',
                        ])
                        ->placeholder('Select priority'),
                    SelectFilter::make('insurance_company_id')
                        ->label('Insurance company')
                        ->relationship('insuranceCompany', 'name')
                        ->searchable()
                        ->preload()
                        ->placeholder('Select insurance company'),
                    SelectFilter::make('adjuster_id')
                        ->label('Adjuster')
                        ->relationship('adjuster', 'name')
                        ->searchable()
                        ->preload()
                        ->placeholder('Select adjuster'),
                    SelectFilter::make('claim_handler')
                        ->label('Chaser')
                        ->options(fn () => Claim::query()
                            ->whereNotNull('claim_handler')
                            ->distinct()
                            ->pluck('claim_handler', 'claim_handler')
                            ->sort()
                            ->all())
                        ->searchable()
                        ->placeholder('Select chaser'),
                    SelectFilter::make('client')
                        ->label('Closer')
                        ->options(fn () => Claim::query()
                            ->whereNotNull('client')
                            ->distinct()
                            ->pluck('client', 'client')
                            ->sort()
                            ->all())
                        ->searchable()
                        ->placeholder('Select closer'),
                    Filter::make('only_assigned_to_me')
                        ->schema([
                            Checkbox::make('isActive')
                                ->label('Only assigned to me'),
                        ])
                        ->query(fn (Builder $query, array $data): Builder => $query
                            ->when($data['isActive'] ?? false, function (Builder $q): Builder {
                                $user = Auth::user();
                                $orgUser = OrganizationUser::query()
                                    ->where('organization_id', $user?->organization_id)
                                    ->where(function ($b) use ($user): void {
                                        $b->where('user_email', $user?->email)->orWhere('user_name', $user?->name);
                                    })
                                    ->first();
                                $name = $orgUser?->user_name ?? $user?->name;
                                if (!$name) {
                                    return $q;
                                }
                                return $q->where(fn ($b) => $b->where('claim_handler', $name)->orWhere('client', $name));
                            })),
                    Filter::make('hide_settled')
                        ->schema([
                            Checkbox::make('isActive')
                                ->label('Hide all settled'),
                        ])
                        ->query(fn (Builder $query, array $data): Builder => $query
                            ->when($data['isActive'] ?? false, fn (Builder $q): Builder => $q->whereNotIn('status_id', [5]))) // Supplement Settled
                ],
                layout: FiltersLayout::Modal
            )
            ->filtersFormColumns(1)
            ->filtersFormSchema(fn (array $filters): array => [
                Section::make('Filter by')
                    ->schema(array_values($filters))
                    ->collapsible(),
            ])
            ->filtersTriggerAction(fn (Action $action) => $action->slideOver())
            ->filtersResetActionPosition(FiltersResetActionPosition::Footer)
            ->filtersApplyAction(fn (Action $action) => $action->label('Apply Filters'))
            ->recordActions([
                ActionGroup::make([
                    Action::make('quickView')
                        ->label('Quick view')
                        ->modalHeading('Claim Details')
                        ->slideOver()
                        ->modalSubmitAction(false)
                        ->modalCancelAction(false)
                        ->infolist(fn (Claim $record) => [
                            TextEntry::make('id')
                                ->label('ID')
                                ->state(fn () => 'P' . str_pad($record->id, 6, '0', STR_PAD_LEFT)),
                            TextEntry::make('claimant')
                                ->label('Claimant'),
                            TextEntry::make('claim_date')
                                ->label('Date')
                                ->date(),
                            TextEntry::make('description')
                                ->label('Description')
                                ->placeholder('—'),
                            TextEntry::make('status.name')
                                ->label('Status')
                                ->badge()
                                ->color(fn () => self::statusColor($record->status?->abbreviation)),
                            TextEntry::make('claim_handler')
                                ->label('Chaser')
                                ->placeholder('N/A'),
                            TextEntry::make('client')
                                ->label('Closer')
                                ->placeholder('N/A'),
                            Section::make('Insurance company info')
                                ->schema([
                                    TextEntry::make('insuranceCompany.name')
                                        ->label('Company')
                                        ->placeholder('—'),
                                    TextEntry::make('insuranceCompany.phone_number')
                                        ->label('Phone')
                                        ->placeholder('—'),
                                    TextEntry::make('insuranceCompany.location')
                                        ->label('Location')
                                        ->placeholder('—'),
                                    TextEntry::make('insuranceCompany.email')
                                        ->label('Email')
                                        ->placeholder('—'),
                                ]),
                            Section::make('Adjuster info')
                                ->schema([
                                    TextEntry::make('adjuster.name')
                                        ->label('Name')
                                        ->placeholder('None'),
                                    TextEntry::make('adjuster.phone_number')
                                        ->label('Phone')
                                        ->placeholder('—'),
                                    TextEntry::make('adjuster.email')
                                        ->label('Email')
                                        ->placeholder('—'),
                                ]),
                            Section::make('Follow-up dates')
                                ->schema([
                                    TextEntry::make('submission_date')
                                        ->label('Submitted to insurance')
                                        ->date()
                                        ->placeholder('N/A'),
                                    TextEntry::make('funding_date')
                                        ->label('Next follow-up')
                                        ->date()
                                        ->placeholder('N/A'),
                                ]),
                            Section::make('Cost')
                                ->schema([
                                    TextEntry::make('original_cost_value')
                                        ->label('Original cost value')
                                        ->money('USD')
                                        ->default(0),
                                    TextEntry::make('settlement_amount')
                                        ->label('Settled cost value')
                                        ->money('USD')
                                        ->default(0),
                                    TextEntry::make('supplement_increase')
                                        ->label('Supplement increase')
                                        ->money('USD')
                                        ->default(0),
                                ]),
                        ]),

                    Action::make('edit')
                        ->label('Edit')
                        ->url(fn (Claim $record) => route('filament.organization.resources.claims.edit', $record)),

                    Action::make('changeStatus')
                        ->label('Change status')
                        ->modalHeading('Change The Claim Status')
                        ->modalWidth('md')
                        ->form([
                            Select::make('status_id')
                                ->label('Claim status')
                                ->options(Status::query()->orderBy('sort_order')->pluck('name', 'id'))
                                ->default(fn (Claim $record) => $record->status_id)
                                ->required(),
                        ])
                        ->modalSubmitActionLabel('Save')
                        ->action(function (Claim $record, array $data): void {
                            $record->update(['status_id' => $data['status_id']]);
                            Notification::make()->title('Claim status updated.')->success()->send();
                        }),

                    Action::make('viewComments')
                        ->label('View all comments')
                        ->modalHeading('All Comments')
                        ->modalWidth('md')
                        ->modalSubmitAction(false)
                        ->modalCancelAction(false)
                        ->modalContent(fn (Claim $record) => view('filament.resources.claims.comments-modal', [
                            'claim' => $record->load('notes'),
                        ])),
                ]),
            ])
            ->defaultSort('claim_date', 'desc');
    }

    public static function statusColor(?string $abbreviation): string
    {
        return match (strtolower($abbreviation ?? '')) {
            'sr' => 'gray',
            'dur' => 'warning',
            'wsc' => 'primary',
            'esti' => 'success',
            'ss' => 'info',
            'none' => 'success',
            'srr' => 'danger',
            'rffi' => 'danger',
            'trn' => 'warning',
            'app' => 'info',
            'strn' => 'success',
            'den' => 'warning',
            'cbc' => 'danger',
            default => 'gray',
        };
    }
}
