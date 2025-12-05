<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('product_name'),
                TextEntry::make('price')
                    ->label("Preis")
                    ->money("EUR"),
                TextEntry::make('stock_quantity')
                    ->label("Lagerbestand")
                    ->numeric(),
                TextEntry::make('category.category_name')
                    ->label("Kategorie")
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
