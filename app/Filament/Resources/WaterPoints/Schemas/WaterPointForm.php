<?php

namespace App\Filament\Resources\WaterPoints\Schemas;

use App\Models\SchemeSubSystem;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use App\Filament\Components\SchemeSelector;

class WaterPointForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    // Step 1: Scheme & Formation
                    Step::make('Scheme & Formation')
                        ->schema(SchemeSelector::make()),

                    Step::make('Water Point Details')
                        ->schema([
                            Section::make('Basic Details')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('water_system_name')->columnSpan(1),

                                        TextInput::make('community_name')->columnSpan(1),
                                        TextInput::make('location_type')->columnSpan(1),
                                        TextInput::make('water_point_name')->columnSpan(1),
                                    ]),
                                ]),

                            Section::make('Population & Users')
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextInput::make('hh')->label('Households')->numeric()->default(0),
                                        TextInput::make('taps')->numeric()->default(0),
                                        TextInput::make('population')->numeric()->default(0),
                                        TextInput::make('total_water_users')->numeric()->default(0),
                                        TextInput::make('unique_water_users')->numeric()->default(0),
                                        TextInput::make('schools')->numeric()->default(0),
                                        TextInput::make('students')->numeric()->default(0),
                                        TextInput::make('health_centers')->numeric()->default(0),
                                        TextInput::make('healthposts')->numeric()->default(0),
                                    ]),
                                ]),

                            Section::make('Other Info')
                                ->schema([
                                    Textarea::make('source_details')->columnSpanFull(),
                                    Textarea::make('hardware_details')->columnSpanFull(),
                                    TextInput::make('latitude')->numeric()->placeholder('e.g. 28.3949'),
                                    TextInput::make('longitude')->numeric()->placeholder('e.g. 84.1240'),
                                    TextInput::make('photo_url')->label('Photo URL'),
                                    Textarea::make('remarks')->columnSpanFull(),
                                ]),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
