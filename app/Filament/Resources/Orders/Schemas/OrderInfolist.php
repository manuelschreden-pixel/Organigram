<?php

namespace App\Filament\Resources\Orders\Schemas;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\RepeatableEntry;


class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)

            ->components([
                Section::make('Bestellinformationen')
                    ->schema([
                        TextEntry::make('customer.fullname')
                            ->label('Kunde'),
                        TextEntry::make('orderstatus.status_name')
                            ->label('Status'),
                        TextEntry::make('order_date')
                            ->label('Bestelldatum'),
                        TextEntry::make('delivery_date')
                            ->label('Abholdatum'),
                        TextEntry::make('PickupLocation')
                            ->label('Abholort'),
                        TextEntry::make('price')
                            ->label('Preis'),
                        TextEntry::make('note')
                            ->label('Notiz'),
                        TextEntry::make('created_at')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->dateTime(),
                    ])
                    ->columns(2),
                    

                
                Section::make('Produkte in der Bestellung')
                    ->schema([
                        RepeatableEntry::make('orderInfos')
                            ->schema([
                                TextEntry::make('product.product_name' )->label('Produktname'),
                                TextEntry::make('note')->label('Notiz'),
                                TextEntry::make('quantity')->label('Menge'),
                                TextEntry::make('positionspreis')
                                    ->label('Preis')
                                    ->getStateUsing(function($record) {
                                        return $record->quantity * ($record->product ? $record->product->price : 0);
                                    })
                                    ->suffix('€')
                            ])
                            ->columns(4)                     
                                ]),

                Section::make('Gesamtpreis')
                    ->schema([
                        TextEntry::make('totalPrice')
                            ->label('Gesamtpreis')
                            ->getStateUsing(function($record) {
                                return $record->orderInfos->sum(function($info) {
                                    return $info->quantity * ($info->product ? $info->product->price : 0);
                                });
                            })
                            ->suffix('€')
                        ]),

            ]);
    }
}
