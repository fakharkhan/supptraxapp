<?php

namespace App\Filament\Organization\Pages;

use App\Models\OrganizationUser;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class Users extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    protected string $view = 'filament.organization.pages.users';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $title = 'Users';

    protected static ?int $navigationSort = 2;

    public function table(Table $table): Table
    {
        $organizationId = Filament::auth()->user()?->organization_id;

        return $table
            ->query(
                OrganizationUser::query()
                    ->when($organizationId, fn (Builder $q) => $q->where('organization_id', $organizationId))
            )
            ->columns([
                TextColumn::make('user_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user_email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->sortable(),
                CheckboxColumn::make('is_chaser')
                    ->label('Chaser')
                    ->alignCenter(),
                CheckboxColumn::make('is_closer')
                    ->label('Closer')
                    ->alignCenter(),
                TextColumn::make('claims_count')
                    ->label('Claims')
                    ->sortable()
                    ->alignCenter(),
            ])
            ->defaultSort('user_name')
            ->defaultPaginationPageOption(10)
            ->recordActions([
                ActionGroup::make([
                    EditAction::make()
                        ->form([
                            TextInput::make('user_name')
                                ->label('Name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('user_email')
                                ->label('Email')
                                ->email()
                                ->required()
                                ->maxLength(255),
                            Select::make('type')
                                ->label('Type')
                                ->options([
                                    'External User' => 'External User',
                                    'Org Member' => 'Org Member',
                                ])
                                ->required(),
                            Toggle::make('is_chaser')
                                ->label('Chaser'),
                            Toggle::make('is_closer')
                                ->label('Closer'),
                        ]),
                    DeleteAction::make(),
                ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createUser')
                ->label('Create new user')
                ->color('primary')
                ->form([
                    TextInput::make('user_name')
                        ->label('Name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('user_email')
                        ->label('Email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Select::make('type')
                        ->label('Type')
                        ->options([
                            'External User' => 'External User',
                            'Org Member' => 'Org Member',
                        ])
                        ->default('External User')
                        ->required(),
                    Toggle::make('is_chaser')
                        ->label('Chaser'),
                    Toggle::make('is_closer')
                        ->label('Closer'),
                ])
                ->action(function (array $data): void {
                    $organizationId = Filament::auth()->user()?->organization_id;

                    if (! $organizationId) {
                        Notification::make()
                            ->title('No organization linked to your account.')
                            ->danger()
                            ->send();

                        return;
                    }

                    OrganizationUser::create([
                        'organization_id' => $organizationId,
                        ...$data,
                    ]);

                    Notification::make()
                        ->title('User created successfully.')
                        ->success()
                        ->send();
                }),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
