<?php

namespace App\Filament\Resources\Schemes\Schemas;

use Filament\Forms\Components\DatePicker;
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
                TextInput::make('province')
                    ->required(),
                TextInput::make('district')
                    ->required(),
                TextInput::make('mun')
                    ->required(),
                TextInput::make('ward_no')
                    ->required()
                    ->numeric(),
                TextInput::make('scheme_code')
                    ->required(),
                TextInput::make('scheme_name')
                    ->required(),
                TextInput::make('scheme_name_np'),
                TextInput::make('collaborator'),
                TextInput::make('sector'),
                TextInput::make('scheme_technology'),
                TextInput::make('scheme_type')
                    ->required()
                    ->default('DWS'),
                TextInput::make('scheme_construction_type')
                    ->required()
                    ->default('New'),
                TextInput::make('scheme_start_year')
                    ->required(),
                DatePicker::make('completion_date'),
                DatePicker::make('agreement_signed_date'),
                DatePicker::make('schedule_end_date'),
                DatePicker::make('started_date'),
                DatePicker::make('planned_completion_date'),
                DatePicker::make('actual_completed_date'),
                Toggle::make('source_registration_status')
                    ->required(),
                Toggle::make('source_conservation')
                    ->required(),
                Toggle::make('no_subscheme')
                    ->required(),
                TextInput::make('progress_status'),
                Textarea::make('justification_for_delay')
                    ->columnSpanFull(),
            ]);
    }
}
