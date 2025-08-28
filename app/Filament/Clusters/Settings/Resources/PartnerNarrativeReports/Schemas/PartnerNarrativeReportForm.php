<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PartnerNarrativeReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('partner_id')
                    ->required()
                    ->numeric(),
                TextInput::make('reporting_period')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('report_files'),
            ]);
    }
}
