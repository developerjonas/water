<?php

namespace App\Filament\Clusters\Budget\Resources\Monitorings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Schema;

class MonitoringInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('monitoring_code')
                    ->label('Monitoring Code')
                    ->copyable()
                    ->color('primary')
                    ->icon('heroicon-o-clipboard'),

                TextEntry::make('scheme_code')
                    ->label('Scheme Code')
                    ->copyable(),

                TextEntry::make('budget_code')
                    ->label('Budget Code')
                    ->copyable(),

                TextEntry::make('monitoring_date')
                    ->label('Monitoring Date')
                    ->date()
                    ->color('info'),

                TextEntry::make('monitored_by')
                    ->label('Monitored By'),

                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        'issues_found' => 'danger',
                        default => 'secondary',
                    }),

                TextEntry::make('remarks')
                    ->label('Remarks')
                    ->limit(100)
                    ->columnSpanFull(),

                RepeatableEntry::make('attachments')
                    ->label('Attached Files')
                    ->schema([
                        TextEntry::make('file')
                            ->label('File')
                            ->url(fn ($record, $state) => asset('storage/'.$state)),
                    ])
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->color('gray'),

                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->color('gray'),
            ]);
    }
}
