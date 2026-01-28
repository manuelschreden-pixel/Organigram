<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Order;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Carbon;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;



class OrdersOverview extends TableWidget
{
    protected static ?string $heading = 'Aktuelle Bestellungen';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = '30s'; //Zeitintervall bis zur nächsten Aktualisierung



    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()->limit(10)
            )
            ->columns([
                TextColumn::make('order_id')
                ->label('Bestellung #')
                ->sortable(),
            TextColumn::make('customer.fullname')
                ->label('Kunde')
                    ->searchable(),

            TextColumn::make('orderStatus.status_name')
                ->badge()
                ->color(fn (string $state) => match ($state) {
                    'Bestellt' => 'warning',
                    'Bezahlt' => 'success',
                    'In Arbeit' => 'danger',
                    default => 'gray',
                }),

                TextColumn::make('price')
                ->label('Gesamtpreis')
                ->getStateUsing(function($record) {
                            return $record->orderInfos->sum(function($info) {
                                return $info->quantity * ($info->product ? $info->product->price : 0);
                            });
                        })
                ->money('EUR'),

            TextColumn::make('created_at')
                ->since()
                ->label('Bestellt vor'),
            TextColumn::make('delivery_date')
                ->label('Abholdatum')
                ->date('d.m.Y'),
            ])
            ->filters([
                Filter::make('today_only')
                ->label('Nur heutige Abholungen')
                ->form([
                    Checkbox::make('today')
                        ->label('Abholtermin ist heute'),
                ])
                ->query(fn (Builder $query, array $data) =>
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
                ->query(fn (Builder $query, array $data) =>
                    $query->when(
                        $data['from_today'] ?? false,
                        fn ($q) => $q->whereDate('delivery_date', '>=', today())
                    )
                ),
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
                ->query(fn (Builder $query, array $data) =>
                    $query->when(
                        $data['start'] ?? false,
                        fn ($q) => $q->whereDate('delivery_date', '>=', $data['start'])
                    )->when(
                        $data['end'] ?? false,
                        fn($q) => $q->whereDate('delivery_date','<=', $data['end'])
                    )
                ),
            
            Filter::make('state')
                ->label('Status')
                ->form([
                    Checkbox::make('ordered')
                        ->label('Bestellt')
                ])
                ->query(function(Builder $query, array $data){
                    return $query->when(
                        $data['ordered'] ?? false,
                        fn($q) => $q->whereHas('orderStatus', function ($q2){
                            $q2->where("status_name", "Bestellt");
                        })
                    );
                })
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
