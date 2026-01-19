<?php

namespace App\Filament\Resources\Adresses\Pages;

use App\Filament\Resources\Adresses\AdressResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAdress extends ViewRecord
{
    protected static string $resource = AdressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
