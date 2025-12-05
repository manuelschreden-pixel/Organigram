<?php

namespace App\Filament\Resources\OrderInfos;

use App\Filament\Resources\OrderInfos\Pages\CreateOrderInfo;
use App\Filament\Resources\OrderInfos\Pages\EditOrderInfo;
use App\Filament\Resources\OrderInfos\Pages\ListOrderInfos;
use App\Filament\Resources\OrderInfos\Pages\ViewOrderInfo;
use App\Filament\Resources\OrderInfos\Schemas\OrderInfoForm;
use App\Filament\Resources\OrderInfos\Schemas\OrderInfoInfolist;
use App\Filament\Resources\OrderInfos\Tables\OrderInfosTable;
use App\Models\OrderInfo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrderInfoResource extends Resource
{
    protected static ?string $model = OrderInfo::class;

    protected static ?string $recordTitleAttribute = 'orderinfo_id';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Bestellinfos';

    protected static ?int $navigationSort = 7;
    

    // 🔹 Einzel-Titel (z. B. beim Bearbeiten)
    public static function getModelLabel(): string
    {
        return 'Bestellinfo';
    }

    // 🔹 Plural-Titel (z. B. Tabellenüberschrift)
    public static function getPluralModelLabel(): string
    {
        return 'Bestellinfos';
    }

    public static function form(Schema $schema): Schema
    {
        return OrderInfoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OrderInfoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrderInfosTable::configure($table);
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
            'index' => ListOrderInfos::route('/'),
            'create' => CreateOrderInfo::route('/create'),
            'view' => ViewOrderInfo::route('/{record}'),
            'edit' => EditOrderInfo::route('/{record}/edit'),
        ];
    }
}
