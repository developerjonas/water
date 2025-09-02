<?php

namespace App\Filament\Resources\WaterPoints\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Grid;
use App\Filament\Components\SchemeSelector;


class WaterPointForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Scheme')->columns(3)->schema(SchemeSelector::make()),
                    Step::make('Water Point Details')->columns(1)
                        ->schema([
                            Grid::make(4)->schema([
                                TextInput::make('sub_system_name')->label('Water Sub-System / Sub-Scheme Name')->required()->columnSpan(2),
                                TextInput::make('water_point_name')->label('Water Point Name')->required()->columnSpan(2),
                                Select::make('location_type')
                                    ->label('Location Type')
                                    ->options([
                                        'community' => 'Community',
                                        'school' => 'School',
                                        'health_center' => 'Health Center / Clinic',
                                        'public_institution' => 'Public Institution / Public Tap',
                                        'other' => 'Others',
                                    ])
                                    ->required(),
                                TextInput::make('woman')->label('Female')->numeric()->default(0)->required(),
                                TextInput::make('man')->label('Male')->numeric()->default(0)->required(),

                                Select::make('tap_construction_status')
                                    ->label('Tap Construction Status')
                                    ->options([
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ])
                                    ->required(),

                                Textarea::make('remarks')->label('Remarks')->columnSpanFull()->nullable(),
                            ]),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
