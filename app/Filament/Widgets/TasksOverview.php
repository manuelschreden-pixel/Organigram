<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Tasks;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Checkbox;

class TasksOverview extends TableWidget
{
    protected static ?string $heading = 'Aktuelle Aufgaben';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = '30s'; //Zeitintervall bis zur nächsten Aktualisierung

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Tasks::query())
            ->columns([
                TextColumn::make('task')
                    ->label('Aufgabe')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Beschreibung'),
                TextColumn::make('completion')
                    ->label('Fertigstellung bis')
                    ->dateTime('d.m.Y H:i'),
                CheckboxColumn::make('state')
                    ->label('Status'),
            ])
            ->filters([
                Filter::make('state2')
                    ->label('Status')
                    ->form([
                        Checkbox::make('isnotDone')
                            ->label('nicht erledigt')
                            ->default(true)
                    ])
                    ->query(function($query, array $data){
                        return $query->when( 
                            $data['isnotDone'] ?? true,
                            fn($q) => $q->where('state','0')
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
