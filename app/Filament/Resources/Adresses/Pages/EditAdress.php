<?php

namespace App\Filament\Resources\Adresses\Pages;

use App\Filament\Resources\Adresses\AdressResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAdress extends EditRecord
{
    protected static string $resource = AdressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
