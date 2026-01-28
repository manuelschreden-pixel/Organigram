<?php

namespace App\Filament\Resources\Adresses;

use App\Filament\Resources\Adresses\Pages\CreateAdress;
use App\Filament\Resources\Adresses\Pages\EditAdress;
use App\Filament\Resources\Adresses\Pages\ListAdresses;
use App\Filament\Resources\Adresses\Pages\ViewAdress;
use App\Filament\Resources\Adresses\Schemas\AdressForm;
use App\Filament\Resources\Adresses\Schemas\AdressInfolist;
use App\Filament\Resources\Adresses\Tables\AdressesTable;
use App\Models\Adress;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdressResource extends Resource
{
    protected static ?string $model = Adress::class;



    protected static ?string $recordTitleAttribute = 'street';

    protected static ?string $navigationLabel = 'Adressverwaltung';                     //Labelname on the left side
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;   //Icon next to the name
    protected static ?int $navigationSort = 5;                                          //sorting order

    // single label
    public static function getModelLabel(): string
    {
        return 'Adresse';
    }

    // plural title tableheading
    public static function getPluralModelLabel(): string
    {
        return 'Adressen';
    }

    public static function form(Schema $schema): Schema
    {
        return AdressForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AdressInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdressesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdresses::route('/'),
            'create' => CreateAdress::route('/create'),
            'view' => ViewAdress::route('/{record}'),
            'edit' => EditAdress::route('/{record}/edit'),
        ];
    }
}
