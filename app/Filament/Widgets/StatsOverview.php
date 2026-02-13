<?php

namespace App\Filament\Widgets;

use App\Models\Device;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    
    protected ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Echipamente', Device::count())
                ->description('Toate dispozitivele')
                ->descriptionIcon('heroicon-m-computer-desktop')
                ->color('primary'),

            Stat::make('Disponibile', Device::where('status', 'disponibil')->count())
                ->description('Pregătite')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('În Service', Device::where('status', 'service')->count())
                ->description('Defecte')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('danger'),
        ];
    }
}