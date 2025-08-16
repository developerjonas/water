<?php

namespace App\Filament\Resources\Trainings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TrainingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_id')
                    ->required()
                    ->numeric(),
                TextInput::make('training_type')
                    ->required(),
                TextInput::make('training_name')
                    ->required(),
                DatePicker::make('training_start_date'),
                DatePicker::make('training_end_date'),
                TextInput::make('training_days')
                    ->numeric(),
                TextInput::make('training_place'),
                TextInput::make('facilitator_name'),
                TextInput::make('num_participating_schools')
                    ->numeric(),
                TextInput::make('teacher_count')
                    ->numeric(),
                TextInput::make('child_club_count')
                    ->numeric(),
                TextInput::make('school_mgmt_committee_count')
                    ->numeric(),
                TextInput::make('dalit_male')
                    ->numeric(),
                TextInput::make('dalit_female')
                    ->numeric(),
                TextInput::make('dalit_total')
                    ->numeric(),
                TextInput::make('janjati_male')
                    ->numeric(),
                TextInput::make('janjati_female')
                    ->numeric(),
                TextInput::make('janjati_total')
                    ->numeric(),
                TextInput::make('other_male')
                    ->numeric(),
                TextInput::make('other_female')
                    ->numeric(),
                TextInput::make('other_total')
                    ->numeric(),
                TextInput::make('male_total')
                    ->numeric(),
                TextInput::make('female_total')
                    ->numeric(),
                TextInput::make('total')
                    ->numeric(),
                TextInput::make('num_schemes_participants')
                    ->numeric(),
                Textarea::make('other')
                    ->columnSpanFull(),
            ]);
    }
}
