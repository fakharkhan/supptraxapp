<?php

namespace App\Filament\Resources\Claims;

use App\Filament\Resources\Claims\Pages\CreateClaim;
use App\Filament\Resources\Claims\Pages\EditClaim;
use App\Filament\Resources\Claims\Pages\ListClaims;
use App\Filament\Resources\Claims\Tables\ClaimsTable;
use App\Models\Claim;
use App\Models\Location;
use App\Models\OrganizationUser;
use App\Models\Status;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use function Filament\Support\original_request;

class ClaimResource extends Resource
{
    protected static ?string $model = Claim::class;

    protected static ?string $recordTitleAttribute = 'claimant';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    public static function getNavigationGroup(): ?string
    {
        if (Filament::getCurrentPanel()?->getId() === 'organization') {
            return 'My Organization';
        }

        return 'Claims';
    }

    public static function getNavigationSort(): ?int
    {
        return Filament::getCurrentPanel()?->getId() === 'organization' ? 1 : null;
    }

    /**
     * @return array<NavigationItem>
     */
    public static function getNavigationItems(): array
    {
        if (Filament::getCurrentPanel()?->getId() !== 'organization') {
            return parent::getNavigationItems();
        }

        $locations = Location::query()->orderBy('name')->pluck('name', 'id');
        $baseUrl = static::getUrl('index');

        $childItems = $locations->map(fn (string $name, int $id) => NavigationItem::make($name)
            ->url($baseUrl . '?' . http_build_query([
                'filters' => ['location_id' => ['value' => $id]],
            ]))
        )->values()->all();

        $activeRoutePattern = static::getNavigationItemActiveRoutePattern();

        return [
            NavigationItem::make(static::getNavigationLabel())
                ->group(static::getNavigationGroup())
                ->icon(static::getNavigationIcon())
                ->activeIcon(static::getActiveNavigationIcon())
                ->isActiveWhen(fn (): bool => original_request()->routeIs($activeRoutePattern))
                ->badge(static::getNavigationBadge(), color: static::getNavigationBadgeColor())
                ->sort(static::getNavigationSort())
                ->url(static::getNavigationUrl())
                ->childItems($childItems),
        ];
    }

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Create Claim')
                ->schema([
                    TextInput::make('id')
                        ->label('Claim ID')
                        ->disabled()
                        ->dehydrated(false)
                        ->placeholder('Auto-generated')
                        ->visibleOn('edit'),
                    DatePicker::make('claim_date')
                        ->label('Claim create date'),
                    TextInput::make('claimant')
                        ->label('Claimant name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('claim_number')
                        ->label('Claim number')
                        ->prefix('#')
                        ->maxLength(255),
                    Textarea::make('description')
                        ->label('Claim description')
                        ->columnSpanFull()
                        ->rows(3),
                    Select::make('status_id')
                        ->label('Claim status')
                        ->options(Status::query()->orderBy('sort_order')->pluck('name', 'id'))
                        ->placeholder('Select status')
                        ->searchable(),
                    Select::make('priority')
                        ->label('Claim priority')
                        ->options([
                            'Low' => 'Low',
                            'Medium' => 'Medium',
                            'High' => 'High',
                            'Urgent' => 'Urgent',
                        ])
                        ->placeholder('Select priority'),
                    Select::make('claim_handler')
                        ->label('Chaser')
                        ->options(fn () => OrganizationUser::query()
                            ->where('is_chaser', true)
                            ->pluck('user_name', 'user_name')
                            ->all())
                        ->placeholder('Select chaser')
                        ->searchable(),
                    Select::make('client')
                        ->label('Closer')
                        ->options(fn () => OrganizationUser::query()
                            ->where('is_closer', true)
                            ->pluck('user_name', 'user_name')
                            ->all())
                        ->placeholder('Select closer')
                        ->searchable(),
                    Select::make('insurance_company_id')
                        ->label('Insurance company')
                        ->relationship('insuranceCompany', 'name')
                        ->placeholder('Select insurance company')
                        ->searchable()
                        ->preload(),
                    Select::make('adjuster_id')
                        ->label('Adjuster')
                        ->relationship('adjuster', 'name')
                        ->placeholder('Select adjuster')
                        ->searchable()
                        ->preload(),
                    Textarea::make('address')
                        ->label('Address')
                        ->rows(2),
                ])
                ->columns(2),

            Section::make('Follow up calendar')
                ->schema([
                    DatePicker::make('submission_date')
                        ->label('Submitted to insurance'),
                ]),

            Section::make()
                ->schema([
                    TextInput::make('original_cost_value')
                        ->label('Original cost value')
                        ->prefix('$')
                        ->numeric(),
                    TextInput::make('settlement_amount')
                        ->label('Settled cost value')
                        ->prefix('$')
                        ->numeric(),
                    TextInput::make('supplement_increase')
                        ->label('Supplement Increase')
                        ->prefix('$')
                        ->numeric(),
                ])
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return ClaimsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'create' => CreateClaim::route('/create'),
            'index' => ListClaims::route('/'),
            'board' => ListClaims::route('/board/{location?}'),
            'edit' => EditClaim::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return true;
    }
}
