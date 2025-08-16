<?php

namespace App\Filament\Resources\Schemes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SchemeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('district')
                    ->required(),
                TextInput::make('mun')
                    ->required(),
                TextInput::make('ward_no')
                    ->required()
                    ->numeric(),
                TextInput::make('donor')
                    ->required(),
                TextInput::make('scheme_code')
                    ->required(),
                TextInput::make('scheme_name')
                    ->required(),
                Select::make('sector')
                    ->options(['Water Supply' => 'Water supply', 'MUS' => 'M u s'])
                    ->required(),
                Select::make('scheme_technology')
                    ->options(['Gravity' => 'Gravity', 'Solar Lift' => 'Solar lift']),
                Select::make('scheme_type')
                    ->options(['New' => 'New', 'Rehab' => 'Rehab'])
                    ->required(),
                TextInput::make('scheme_start_year')
                    ->required(),
                Toggle::make('source_registration_status')
                    ->required(),
                TextInput::make('no_subscheme')
                    ->numeric(),
                TextInput::make('completed_year'),
                DatePicker::make('completion_date'),
                Toggle::make('source_conservation')
                    ->required(),
                DatePicker::make('agreement_signed_date'),
                DatePicker::make('schedule_end_date'),
                DatePicker::make('started_date'),
                DatePicker::make('planned_completion_date'),
                DatePicker::make('actual_completed_date'),
                Select::make('progress_status')
                    ->options(['Completed' => 'Completed', 'Ongoing' => 'Ongoing', 'Dropout' => 'Dropout'])
                    ->required(),
                Textarea::make('justification_for_delay')
                    ->columnSpanFull(),
            ]);
    }
}
