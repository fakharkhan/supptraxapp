<?php

namespace App\Filament\Resources\InsuranceCompanies;

use App\Filament\Resources\InsuranceCompanies\Pages\CreateInsuranceCompany;
use App\Filament\Resources\InsuranceCompanies\Pages\EditInsuranceCompany;
use App\Filament\Resources\InsuranceCompanies\Pages\ListInsuranceCompanies;
use App\Filament\Resources\InsuranceCompanies\Schemas\InsuranceCompanyForm;
use App\Filament\Resources\InsuranceCompanies\Tables\InsuranceCompaniesTable;
use App\Models\InsuranceCompany;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InsuranceCompanyResource extends Resource
{
    protected static ?string $model = InsuranceCompany::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    public static function getNavigationGroup(): ?string
    {
        if (Filament::getCurrentPanel()?->getId() === 'organization') {
            return null;
        }

        return 'Reference Data';
    }

    public static function getNavigationSort(): ?int
    {
        return Filament::getCurrentPanel()?->getId() === 'organization' ? 1 : null;
    }

    public static function form(Schema $schema): Schema
    {
        return InsuranceCompanyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InsuranceCompaniesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInsuranceCompanies::route('/'),
            'create' => CreateInsuranceCompany::route('/create'),
            'edit' => EditInsuranceCompany::route('/{record}/edit'),
        ];
    }
}
