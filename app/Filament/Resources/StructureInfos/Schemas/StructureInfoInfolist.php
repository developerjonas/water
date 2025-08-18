<?php

namespace App\Filament\Resources\StructureInfos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StructureInfoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_id')
                    ->numeric(),
                TextEntry::make('intake_estimated')
                    ->numeric(),
                TextEntry::make('intake_achieved')
                    ->numeric(),
                TextEntry::make('intake_filter_estimated')
                    ->numeric(),
                TextEntry::make('intake_filter_achieved')
                    ->numeric(),
                TextEntry::make('dc_ic_cc_estimated')
                    ->numeric(),
                TextEntry::make('dc_ic_cc_achieved')
                    ->numeric(),
                TextEntry::make('rvt_estimated')
                    ->numeric(),
                TextEntry::make('rvt_achieved')
                    ->numeric(),
                TextEntry::make('bpt_estimated')
                    ->numeric(),
                TextEntry::make('bpt_achieved')
                    ->numeric(),
                TextEntry::make('frc_estimated')
                    ->numeric(),
                TextEntry::make('frc_achieved')
                    ->numeric(),
                TextEntry::make('private_tap_estimated')
                    ->numeric(),
                TextEntry::make('private_tap_achieved')
                    ->numeric(),
                TextEntry::make('institutional_tap_estimated')
                    ->numeric(),
                TextEntry::make('institutional_tap_achieved')
                    ->numeric(),
                TextEntry::make('transmission_line_estimated')
                    ->numeric(),
                TextEntry::make('transmission_line_achieved')
                    ->numeric(),
                TextEntry::make('distribution_line_estimated')
                    ->numeric(),
                TextEntry::make('distribution_line_achieved')
                    ->numeric(),
                TextEntry::make('private_line_estimated')
                    ->numeric(),
                TextEntry::make('private_line_achieved')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
