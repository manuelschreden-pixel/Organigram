<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CustomerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('prename')
                    ->label('Vorname'),
                TextEntry::make('surname')
                    ->label('Nachname'),
                TextEntry::make('adress.full_address')
                    ->label('Adresse'),
                TextEntry::make('email')
                    ->label('EMail'),
                TextEntry::make('telephonenumber')
                    ->label('Telephonnummer'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
