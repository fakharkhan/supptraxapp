<?php

namespace App\Filament\Organization\Pages;

use App\Models\Organization;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Details extends Page
{
    protected string $view = 'filament.organization.pages.details';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;

    protected static ?string $title = 'Details';

    protected static ?int $navigationSort = 1;

    public ?Organization $organization = null;

    public function mount(): void
    {
        $this->organization = Filament::auth()->user()?->organization;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function serviceAgreementAction(): Action
    {
        return Action::make('serviceAgreement')
            ->label('Service agreement')
            ->color('primary')
            ->link()
            ->modalHeading('Service Agreement')
            ->modalWidth('3xl')
            ->modalSubmitActionLabel('OK')
            ->modalCancelAction(false)
            ->action(fn () => null)
            ->modalContent(view('filament.organization.pages.details-service-agreement', [
                'organization' => $this->organization,
            ]));
    }

    public function editContactFullNameAction(): Action
    {
        return Action::make('editContactFullName')
            ->label('Edit Full Name')
            ->modalHeading('Edit Full Name')
            ->form([
                TextInput::make('contact_full_name')
                    ->label('Full name')
                    ->default($this->organization?->contact_full_name)
                    ->required(),
            ])
            ->action(function (array $data): void {
                $this->organization?->update(['contact_full_name' => $data['contact_full_name']]);
                $this->organization?->refresh();
                Notification::make()->title('Contact name updated.')->success()->send();
            });
    }

    public function editContactPhoneAction(): Action
    {
        return Action::make('editContactPhone')
            ->label('Edit Phone')
            ->modalHeading('Edit Phone Number')
            ->form([
                TextInput::make('contact_phone')
                    ->label('Phone number')
                    ->default($this->organization?->contact_phone)
                    ->required(),
            ])
            ->action(function (array $data): void {
                $this->organization?->update(['contact_phone' => $data['contact_phone']]);
                $this->organization?->refresh();
                Notification::make()->title('Phone number updated.')->success()->send();
            });
    }

    public function editContactEmailAction(): Action
    {
        return Action::make('editContactEmail')
            ->label('Edit Email')
            ->modalHeading('Edit Email')
            ->form([
                TextInput::make('contact_email')
                    ->label('Email')
                    ->email()
                    ->default($this->organization?->contact_email)
                    ->required(),
            ])
            ->action(function (array $data): void {
                $this->organization?->update(['contact_email' => $data['contact_email']]);
                $this->organization?->refresh();
                Notification::make()->title('Email updated.')->success()->send();
            });
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
