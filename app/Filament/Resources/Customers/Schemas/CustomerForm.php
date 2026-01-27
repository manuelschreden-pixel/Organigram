<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('prename')
                    ->label('Vorname')
                    ->required(),
                TextInput::make('surname')
                    ->label('Nachname')
                    ->required(),

                Select::make('adress_id')
                    ->relationship('adress', 'street')
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return $record->street . ' ' . $record->housenumber . ', ' . $record->plz . ' ' . $record->town;
                    })
                    ->createOptionForm([
                        TextInput::make('street')
                        ->required()
                        ->label('Straße'),
                        TextInput::make('housenumber')
                        ->required()
                        ->label('Hausnummer'),
                        TextInput::make('plz')
                        ->required()
                        ->label('PLZ'),
                        TextInput::make('town')
                        ->required()
                        ->label('Ort'),
                    ])
                    ->searchable()
                    ->preload(),

                TextInput::make('email')
                    ->label('EMail')
                    ->email()
                    ->default(null),
                TextInput::make('telephonenumber')
                    ->label('Telefonnummer')
                    ->tel()
                    ->default(null),
            ]);
    }
}
