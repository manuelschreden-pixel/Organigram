<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;

class ProductOrderOverview extends TableWidget
{
    protected static ?string $heading = 'Summe der bestellten Produkte';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            
            ->query(
                Product::query()
                    ->join('orderinfo','orderinfo.product_id', '=', 'products.product_id')
                    ->selectRaw('products.product_id, products.product_name, SUM(orderinfo.quantity) as total_quantity')
                    ->groupBy('products.product_id', 'products.product_name')
            )
            ->columns([
                TextColumn::make('product_name')
                    ->label('Produktname')
                    ->searchable(),

                TextColumn::make('total_quantity')
                    ->label('Gesamtbestellmenge')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('date_range')
                    ->form([
                        DatePicker::make('start_date')->label('Startdatum'),
                        DatePicker::make('end_date')->label('Enddatum'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        $query
                            ->when(
                                $data['start_date'],
                                fn ($q) => $q->whereDate('created_at', '>=', $data['start_date'])
                            )
                            ->when(
                                $data['end_date'],
                                fn ($q) => $q->whereDate('created_at', '<=', $data['end_date'])
                            );
                    }),
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
