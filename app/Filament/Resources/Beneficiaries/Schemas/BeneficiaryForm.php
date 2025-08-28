<?php

namespace App\Filament\Resources\Beneficiaries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use App\Filament\Components\SchemeSelector;

class BeneficiaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Scheme & Formation')
                    ->schema(SchemeSelector::make()),

                    Wizard\Step::make('Household Beneficiaries')
                        ->schema([
                            TextInput::make('dalit_hh_poor')
                                ->label('Dalit Poor HH')
                                ->numeric()
                                ->default(0),
                            TextInput::make('dalit_hh_nonpoor')
                                ->label('Dalit Non-Poor HH')
                                ->numeric()
                                ->default(0),
                            TextInput::make('aj_hh_poor')
                                ->label('A/J Poor HH')
                                ->numeric()
                                ->default(0),
                            TextInput::make('aj_hh_nonpoor')
                                ->label('A/J Non-Poor HH')
                                ->numeric()
                                ->default(0),
                            TextInput::make('other_hh_poor')
                                ->label('Other Poor HH')
                                ->numeric()
                                ->default(0),
                            TextInput::make('other_hh_nonpoor')
                                ->label('Other Non-Poor HH')
                                ->numeric()
                                ->default(0),
                        ]),

                    Step::make('Individual Beneficiaries')
                        ->schema([
                            TextInput::make('dalit_female')
                                ->label('Dalit Female')
                                ->numeric()
                                ->default(0),
                            TextInput::make('dalit_male')
                                ->label('Dalit Male')
                                ->numeric()
                                ->default(0),
                            TextInput::make('aj_female')
                                ->label('A/J Female')
                                ->numeric()
                                ->default(0),
                            TextInput::make('aj_male')
                                ->label('A/J Male')
                                ->numeric()
                                ->default(0),
                            TextInput::make('others_female')
                                ->label('Others Female')
                                ->numeric()
                                ->default(0),
                            TextInput::make('others_male')
                                ->label('Others Male')
                                ->numeric()
                                ->default(0),
                        ]),

                    Step::make('School / Population')
                        ->schema([
                            TextInput::make('base_population')
                                ->label('Base Population')
                                ->numeric()
                                ->default(0),
                            TextInput::make('boys_student')
                                ->label('Boys Students')
                                ->numeric()
                                ->default(0),
                            TextInput::make('girls_student')
                                ->label('Girls Students')
                                ->numeric()
                                ->default(0),
                            TextInput::make('teachers_staff')
                                ->label('Teachers / Staff')
                                ->numeric()
                                ->default(0),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
