<?php

namespace App\Filament\Resources\OrderInfos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderInfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_id')
                    ->required()
                    ->numeric(),
                TextInput::make('product_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
            ]);
    }
}
