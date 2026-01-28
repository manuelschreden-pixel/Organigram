<?php

namespace App\Filament\Resources\Tasks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Checkbox;

class TasksTable
{
    public static function configure(Table $table): Table
    {
        return $table
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
                    ->label('Status')
                    ->searchable(),
            ])
            ->filters([
                Filter::make('state')
                    ->label('Status')
                    ->form([
                        Checkbox::make('isDone')
                            ->label('erledigt')
                    ])
                    ->query(function($query, array $data){
                        return $query->when(
                            $data['isDone'] ?? false,
                            fn($q) => $q->where('state','1')
                        );
                    }),

                Filter::make('state2')
                    ->label('Status')
                    ->form([
                        Checkbox::make('isnotDone')
                            ->label('nicht erledigt')
                    ])
                    ->query(function($query, array $data){
                        return $query->when(
                            $data['isnotDone'] ?? false,
                            fn($q) => $q->where('state','0')
                        );
                    }),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
