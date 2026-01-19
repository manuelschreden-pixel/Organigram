<?php

namespace App\Filament\Resources\OrderStatuses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderStatusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('status_name')
                    ->label('Statusname')
                    ->required(),
            ]);
    }
}
