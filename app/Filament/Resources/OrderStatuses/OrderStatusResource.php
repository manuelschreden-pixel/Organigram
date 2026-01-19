<?php

namespace App\Filament\Resources\OrderStatuses;

use App\Filament\Resources\OrderStatuses\Pages\CreateOrderStatus;
use App\Filament\Resources\OrderStatuses\Pages\EditOrderStatus;
use App\Filament\Resources\OrderStatuses\Pages\ListOrderStatuses;
use App\Filament\Resources\OrderStatuses\Pages\ViewOrderStatus;
use App\Filament\Resources\OrderStatuses\Schemas\OrderStatusForm;
use App\Filament\Resources\OrderStatuses\Schemas\OrderStatusInfolist;
use App\Filament\Resources\OrderStatuses\Tables\OrderStatusesTable;
use App\Models\OrderStatus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrderStatusResource extends Resource
{
    protected static ?string $model = OrderStatus::class;

    protected static ?string $recordTitleAttribute = 'status_name';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Bestellstatusse';

    protected static ?int $navigationSort = 6;
    

    // 🔹 Einzel-Titel (z. B. beim Bearbeiten)
    public static function getModelLabel(): string
    {
        return 'Status';
    }

    // 🔹 Plural-Titel (z. B. Tabellenüberschrift)
    public static function getPluralModelLabel(): string
    {
        return 'Statusse';
    }

    public static function form(Schema $schema): Schema
    {
        return OrderStatusForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OrderStatusInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrderStatusesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrderStatuses::route('/'),
            'create' => CreateOrderStatus::route('/create'),
            'view' => ViewOrderStatus::route('/{record}'),
            'edit' => EditOrderStatus::route('/{record}/edit'),
        ];
    }
}
