<?php

namespace App\Filament\Resources\Orders\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;

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
                    ->sortable()
                    ->color(fn (string $state) => match ($state) {
                        'Bestellt' => 'warning',
                        'Bezahlt' => 'success',
                        'In Arbeit' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('order_date')
                    ->label('Bestelldatum')
                    ->date()
                    ->sortable(),
                TextColumn::make('delivery_date')
                    ->label('Abholdatum')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
                Filter::make('state')
                    ->label('Status')
                    ->form([
                        Checkbox::make('ordered')
                            ->label('Bestellt')
                    ])
                    ->query(function($query, array $data){
                        return $query->when(
                            $data['ordered'] ?? false,
                            fn($q) => $q->whereHas('orderStatus', function ($q2){
                                $q2->where("status_name", "Bestellt");
                            })
                        );
                    }),

                Filter::make('timespan')
                    ->label('Ab heute')
                    ->form([
                        Section::make("Zeitspanne")
                            ->schema([
                                DatePicker::make('start')
                                    ->label("Von"),
                                DatePicker::make('end')
                                    ->label("Bis")
                            ])
                            
                    ])
                    ->query(fn ($query, array $data) =>
                        $query->when(
                            $data['start'] ?? false,
                            fn ($q) => $q->whereDate('delivery_date', '>=', $data['start'])
                        )->when(
                            $data['end'] ?? false,
                            fn($q) => $q->whereDate('delivery_date','<=', $data['end'])
                        )
                    ),

                Filter::make('today_only')
                    ->label('Nur heutige Abholungen')
                    ->form([
                        Checkbox::make('today')
                            ->label('Abholtermin ist heute'),
                    ])
                    ->query(fn ($query, array $data) =>
                        $query->when(
                            $data['today'] ?? false,
                            fn ($q) => $q->whereDate('delivery_date', today())
                        )
                    ),
                Filter::make('from_today')
                    ->label('Zeitspanne')
                    ->form([
                        Checkbox::make('from_today')
                            ->label('Alle Abholungen ab heute'),
                    ])
                    ->query(fn ($query, array $data) =>
                        $query->when(
                            $data['from_today'] ?? false,
                            fn ($q) => $q->whereDate('delivery_date', '>=', today())
                        )
                    ),
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
