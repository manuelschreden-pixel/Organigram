<?php

namespace App\Filament\Resources\Adresses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AdressInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('street')
                ->label('Straße'),
                TextEntry::make('housenumber')
                ->label('Hausnummer'),
                TextEntry::make('plz')
                ->label('PLZ'),
                TextEntry::make('town')
                ->label('Ort'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
