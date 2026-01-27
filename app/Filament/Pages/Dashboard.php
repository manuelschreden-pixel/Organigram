<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
//use Livewire\OrdersOverview;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Übersicht';

    public function getWidgets(): array
    {
        return[
            \App\Filament\Widgets\OrdersOverview::class,
            \App\Filament\Widgets\TasksOverview::class,
        ];
    }

    //protected string $view = 'filament.pages.dashboard';
}
