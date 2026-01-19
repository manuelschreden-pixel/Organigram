<?php

namespace App\Filament\Resources\Adresses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AdressForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('street')
                    ->required(),
                TextInput::make('housenumber')
                    ->default(null),
                TextInput::make('plz')
                    ->required(),
                TextInput::make('town')
                    ->required(),
            ]);
    }
}
