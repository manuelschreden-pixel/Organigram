<?php

namespace App\Filament\Resources\Orders\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.fullname')
                    ->label('Kunde')
                    ->searchable(),
                TextColumn::make('orderStatus.status_name')
                    ->label('Status')
                    ->sortable(),
                TextColumn::make('order_date')
                    ->label('Bestelldatum')
                    ->date()
                    ->sortable(),
                TextColumn::make('delivery_date')
                    ->label('Abholdatum')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('PickupLocation')
                    ->label('Abholort')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('price')
                    ->label('Gesamtpreis')
                    ->getStateUsing(function($record) {
                                return $record->orderInfos->sum(function($info) {
                                    return $info->quantity * ($info->product ? $info->product->price : 0);
                                });
                            })
                    ->money('EUR'),
                TextColumn::make('note')
                    ->label('Notiz')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
