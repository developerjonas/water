<?php

namespace App\Filament\Resources\Structures\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StructureInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code'),
                TextEntry::make('intakes_constructed')
                    ->numeric(),
                TextEntry::make('intakes_remaining')
                    ->numeric(),
                TextEntry::make('rvts_constructed')
                    ->numeric(),
                TextEntry::make('rvts_remaining')
                    ->numeric(),
                TextEntry::make('cc_dc_bpt_constructed')
                    ->numeric(),
                TextEntry::make('cc_dc_bpt_remaining')
                    ->numeric(),
                TextEntry::make('other_structures_constructed')
                    ->numeric(),
                TextEntry::make('other_structures_remaining')
                    ->numeric(),
                TextEntry::make('public_taps')
                    ->numeric(),
                TextEntry::make('school_taps')
                    ->numeric(),
                TextEntry::make('private_taps')
                    ->numeric(),
                TextEntry::make('taps_constructed_progress')
                    ->numeric(),
                TextEntry::make('taps_remaining')
                    ->numeric(),
                TextEntry::make('transmission_line_progress')
                    ->numeric(),
                TextEntry::make('transmission_line_remaining')
                    ->numeric(),
                TextEntry::make('distribution_line_progress')
                    ->numeric(),
                TextEntry::make('distribution_line_remaining')
                    ->numeric(),
                TextEntry::make('private_line_progress')
                    ->numeric(),
                TextEntry::make('private_line_remaining')
                    ->numeric(),
                IconEntry::make('mb_submitted_to_municipality')
                    ->boolean(),
                IconEntry::make('municipality_contribution_transferred')
                    ->boolean(),
                IconEntry::make('public_hearing_done')
                    ->boolean(),
                IconEntry::make('public_review_done')
                    ->boolean(),
                IconEntry::make('final_public_audit_done')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
