<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_name')
                    ->label("Produktname")
                    ->required(),
                Textarea::make('description')
                    ->label("Beschreibung")
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->label("Preis")
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                TextInput::make('stock_quantity')
                    ->label("Lagerbestand")
                    ->numeric()
                    ->default(0),
                Select::make('category_id')
                    ->relationship('category', 'category_name')
                    ->createOptionForm([
                        TextInput::make('category_name')
                        ->required()
                        ->label('Kategoriename'),
                    ])
                    ->searchable()
                    ->preload(),
            ]);
    }
}
