<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Schema;

class PartnerNarrativeReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('partner.name') // Display partner name instead of ID
                    ->label('Partner'),

                TextEntry::make('reporting_period')
                    ->label('Reporting Period'),

                RepeatableEntry::make('report_files') // Show uploaded files as links
                    ->label('Report Files')
                    ->formatStateUsing(fn ($state) => collect($state)->map(function ($file) {
                        return "<a href='".asset('storage/'.$file)."' target='_blank'>Download</a>";
                    })->implode(', '))
                    ->html(),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(),
            ]);
    }
}
