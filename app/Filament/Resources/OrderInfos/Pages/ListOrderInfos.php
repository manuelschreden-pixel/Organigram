<?php

namespace App\Filament\Resources\OrderInfos\Pages;

use App\Filament\Resources\OrderInfos\OrderInfoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrderInfos extends ListRecords
{
    protected static string $resource = OrderInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
