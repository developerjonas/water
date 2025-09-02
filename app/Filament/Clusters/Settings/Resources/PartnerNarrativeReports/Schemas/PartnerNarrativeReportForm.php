<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class PartnerNarrativeReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('partner_id')
                    ->label('Partner')
                    ->relationship('partner', 'name') // Assumes Partner model with 'name' field
                    ->searchable()
                    ->required(),

                Select::make('reporting_period')
                    ->label('Reporting Period')
                    ->options([
                        'Q1' => 'Quarter 1',
                        'Q2' => 'Quarter 2',
                        'Q3' => 'Quarter 3',
                        'Q4' => 'Quarter 4',
                    ])
                    ->required(),

                Textarea::make('notes')
                    ->label('Notes')
                    ->columnSpanFull(),

                FileUpload::make('report_files')
                    ->label('Report Files')
                    ->disk('public') // Change to S3 or other disk if needed
                    ->directory('reports/narratives')
                    ->multiple()
                    ->downloadable()
                    ->previewable()
                    ->maxSize(10240), // 10MB
            ]);
    }
}
