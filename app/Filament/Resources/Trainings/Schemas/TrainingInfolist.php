<?php

namespace App\Filament\Resources\Trainings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TrainingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_id')
                    ->numeric(),
                TextEntry::make('training_type'),
                TextEntry::make('training_name'),
                TextEntry::make('training_start_date')
                    ->date(),
                TextEntry::make('training_end_date')
                    ->date(),
                TextEntry::make('training_days')
                    ->numeric(),
                TextEntry::make('training_place'),
                TextEntry::make('facilitator_name'),
                TextEntry::make('num_participating_schools')
                    ->numeric(),
                TextEntry::make('teacher_count')
                    ->numeric(),
                TextEntry::make('child_club_count')
                    ->numeric(),
                TextEntry::make('school_mgmt_committee_count')
                    ->numeric(),
                TextEntry::make('dalit_male')
                    ->numeric(),
                TextEntry::make('dalit_female')
                    ->numeric(),
                TextEntry::make('dalit_total')
                    ->numeric(),
                TextEntry::make('janjati_male')
                    ->numeric(),
                TextEntry::make('janjati_female')
                    ->numeric(),
                TextEntry::make('janjati_total')
                    ->numeric(),
                TextEntry::make('other_male')
                    ->numeric(),
                TextEntry::make('other_female')
                    ->numeric(),
                TextEntry::make('other_total')
                    ->numeric(),
                TextEntry::make('male_total')
                    ->numeric(),
                TextEntry::make('female_total')
                    ->numeric(),
                TextEntry::make('total')
                    ->numeric(),
                TextEntry::make('num_schemes_participants')
                    ->numeric(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
