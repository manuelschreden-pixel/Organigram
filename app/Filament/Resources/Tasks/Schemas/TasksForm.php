<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Checkbox;

class TasksForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('task')
                    ->label("Aufgabe")
                    ->required(),
                TextInput::make('description')
                    ->label("Beschreibung"),
                DateTimePicker::make('completion')
                    ->label("Fertigstellung bis"),
                Checkbox::make('state')
                    ->label("Status")
                    ->default('0'),
            ]);
    }
}
