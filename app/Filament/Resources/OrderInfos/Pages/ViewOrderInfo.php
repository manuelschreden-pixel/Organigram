<?php

namespace App\Filament\Resources\OrderInfos\Pages;

use App\Filament\Resources\OrderInfos\OrderInfoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOrderInfo extends ViewRecord
{
    protected static string $resource = OrderInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
