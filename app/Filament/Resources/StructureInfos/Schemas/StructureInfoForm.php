<?php

namespace App\Filament\Resources\StructureInfos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StructureInfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_id')
                    ->required()
                    ->numeric(),
                TextInput::make('intake_estimated')
                    ->numeric(),
                TextInput::make('intake_achieved')
                    ->numeric(),
                TextInput::make('intake_filter_estimated')
                    ->numeric(),
                TextInput::make('intake_filter_achieved')
                    ->numeric(),
                TextInput::make('dc_ic_cc_estimated')
                    ->numeric(),
                TextInput::make('dc_ic_cc_achieved')
                    ->numeric(),
                TextInput::make('rvt_estimated')
                    ->numeric(),
                TextInput::make('rvt_achieved')
                    ->numeric(),
                TextInput::make('bpt_estimated')
                    ->numeric(),
                TextInput::make('bpt_achieved')
                    ->numeric(),
                TextInput::make('frc_estimated')
                    ->numeric(),
                TextInput::make('frc_achieved')
                    ->numeric(),
                TextInput::make('private_tap_estimated')
                    ->numeric(),
                TextInput::make('private_tap_achieved')
                    ->numeric(),
                TextInput::make('institutional_tap_estimated')
                    ->numeric(),
                TextInput::make('institutional_tap_achieved')
                    ->numeric(),
                TextInput::make('transmission_line_estimated')
                    ->numeric(),
                TextInput::make('transmission_line_achieved')
                    ->numeric(),
                TextInput::make('distribution_line_estimated')
                    ->numeric(),
                TextInput::make('distribution_line_achieved')
                    ->numeric(),
                TextInput::make('private_line_estimated')
                    ->numeric(),
                TextInput::make('private_line_achieved')
                    ->numeric(),
            ]);
    }
}
