<?php

namespace App\Filament\Clusters\Budget\Resources\Monitorings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MonitoringForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('budget_id')
                    ->required()
                    ->numeric(),
                TextInput::make('file_path')
                    ->required(),
                DatePicker::make('monitoring_date')
                    ->required(),
                Textarea::make('remarks')
                    ->columnSpanFull(),
            ]);
    }
}
