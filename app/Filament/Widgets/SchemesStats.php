<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Scheme;

class SchemesStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Schemes', Scheme::count())
                ->icon('heroicon-o-rectangle-stack') // ✅ Replaces collection
                ->color('primary'),

            Stat::make('Ongoing', Scheme::where('progress_status', 'Ongoing')->count())
                ->icon('heroicon-o-arrow-path') // ✅ Replaces refresh
                ->color('warning'),

            Stat::make('Completed', Scheme::where('progress_status', 'Completed')->count())
                ->icon('heroicon-o-check-circle') // ✅ Valid
                ->color('success'),
        ];
    }
}
