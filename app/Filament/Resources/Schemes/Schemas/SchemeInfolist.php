<?php

namespace App\Filament\Resources\Schemes\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SchemeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('district'),
                TextEntry::make('mun'),
                TextEntry::make('ward_no')
                    ->numeric(),
                TextEntry::make('donor'),
                TextEntry::make('scheme_code'),
                TextEntry::make('scheme_name'),
                TextEntry::make('sector'),
                TextEntry::make('scheme_technology'),
                TextEntry::make('scheme_type'),
                TextEntry::make('scheme_start_year'),
                IconEntry::make('source_registration_status')
                    ->boolean(),
                TextEntry::make('no_subscheme')
                    ->numeric(),
                TextEntry::make('completed_year'),
                TextEntry::make('completion_date')
                    ->date(),
                IconEntry::make('source_conservation')
                    ->boolean(),
                TextEntry::make('agreement_signed_date')
                    ->date(),
                TextEntry::make('schedule_end_date')
                    ->date(),
                TextEntry::make('started_date')
                    ->date(),
                TextEntry::make('planned_completion_date')
                    ->date(),
                TextEntry::make('actual_completed_date')
                    ->date(),
                TextEntry::make('progress_status'),
                TextEntry::make('deleted_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
