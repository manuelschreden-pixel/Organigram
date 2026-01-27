<?php

namespace App\Filament\Resources\OrderInfos\Pages;

use App\Filament\Resources\OrderInfos\OrderInfoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditOrderInfo extends EditRecord
{
    protected static string $resource = OrderInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
