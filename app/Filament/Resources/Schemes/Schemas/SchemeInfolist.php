<?php

namespace App\Filament\Resources\Schemes\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use App\Models\Donor;

class SchemeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('province'),
                TextEntry::make('district'),
                TextEntry::make('mun'),
                TextEntry::make('ward_no')->numeric(),
                TextEntry::make('scheme_code'),
                TextEntry::make('scheme_name'),
                TextEntry::make('scheme_name_np'),
                TextEntry::make('sector'),
                TextEntry::make('scheme_technology'),
                TextEntry::make('scheme_type'),
                TextEntry::make('scheme_construction_type'),
                TextEntry::make('scheme_start_year'),
                TextEntry::make('completion_date')->date(),
                TextEntry::make('agreement_signed_date')->date(),
                TextEntry::make('schedule_end_date')->date(),
                TextEntry::make('started_date')->date(),
                TextEntry::make('planned_completion_date')->date(),
                TextEntry::make('actual_completed_date')->date(),
                IconEntry::make('source_registration_status')->boolean(),
                IconEntry::make('source_conservation')->boolean(),
                IconEntry::make('no_subscheme')->boolean(),
                TextEntry::make('progress_status'),

                // Display collaborator donor names
                TextEntry::make('collaborator')
                    ->label('Donors')
                    ->getStateUsing(function ($record) {
                        if (empty($record->collaborator)) {
                            return '-';
                        }
                        // Fetch donor names from IDs
                        $names = Donor::whereIn('id', $record->collaborator)->pluck('name')->toArray();
                        return implode(', ', $names);
                    }),

                TextEntry::make('deleted_at')->dateTime(),
                TextEntry::make('created_at')->dateTime(),
                TextEntry::make('updated_at')->dateTime(),
            ]);
    }
}
