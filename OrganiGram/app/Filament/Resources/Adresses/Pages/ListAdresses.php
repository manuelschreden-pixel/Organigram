<?php

namespace App\Filament\Resources\Adresses\Pages;

use App\Filament\Resources\Adresses\AdressResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdresses extends ListRecords
{
    protected static string $resource = AdressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
