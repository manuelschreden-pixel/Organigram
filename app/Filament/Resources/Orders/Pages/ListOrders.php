<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
    /*
    public function getTabs(): array
    {
        return [
            'table' => Tab::make('Bestellungen'),
            'overview' => Tab::make('Anzahl Übersicht')
        ];
    }

    public function getDefaultActiveTab(): ?string
    {
        return 'table';
    }*/
}
