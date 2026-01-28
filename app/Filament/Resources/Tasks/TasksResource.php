<?php

namespace App\Filament\Resources\Tasks;

use App\Filament\Resources\Tasks\Pages\CreateTasks;
use App\Filament\Resources\Tasks\Pages\EditTasks;
use App\Filament\Resources\Tasks\Pages\ListTasks;
use App\Filament\Resources\Tasks\Schemas\TasksForm;
use App\Filament\Resources\Tasks\Tables\TasksTable;
use App\Models\Tasks;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TasksResource extends Resource
{
    protected static ?string $model = Tasks::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'task';

    // 🔹 Einzel-Titel (z. B. beim Bearbeiten)
    public static function getModelLabel(): string
    {
        return 'Aufgabe';
    }

    // 🔹 Plural-Titel (z. B. Tabellenüberschrift)
    public static function getPluralModelLabel(): string
    {
        return 'Aufgaben';
    }

    public static function form(Schema $schema): Schema
    {
        return TasksForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TasksTable::configure($table);
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
            'index' => ListTasks::route('/'),
            'create' => CreateTasks::route('/create'),
            'edit' => EditTasks::route('/{record}/edit'),
        ];
    }
}
