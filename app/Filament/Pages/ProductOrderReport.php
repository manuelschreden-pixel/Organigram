<?php

namespace App\Filament\Pages;

use App\Models\OrderInfo;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

class ProductOrderReport extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;
    protected static ?string $navigationLabel = 'Produkt Bestellbericht';
    protected static ?string $title = 'Produkt Bestellbericht';

    public function getHeaderWidgets(): array
    {
        return[
            \App\Filament\Widgets\ProductOrderOverview::class,
        ];
    }
}
