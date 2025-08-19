<?php

namespace App\Filament\Resources\PublicAudits\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
// use Filament\Forms\Components\Wizard;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
// use Filament\Forms\Components\Select;
use App\Models\Scheme;

class PublicAuditForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Wizard\Step::make('Select Scheme')
                        ->schema([
        Select::make('scheme_code') // This is what will be stored in the database
            ->label('Scheme Name') // This is what the user sees
            ->required()
            ->searchable()
            ->placeholder('Select a scheme')
            ->options(function () {
                // Fetch all schemes and return [scheme_code => scheme_name]
                return Scheme::query()
                    ->orderBy('scheme_name')
                    ->pluck('scheme_name', 'scheme_code')
                    ->toArray();
            }),
    ]),

                    Wizard\Step::make('Public Audit Data')
                        ->schema([
                            Select::make('audit_type')
                                ->label('Audit Type')
                                ->options([
                                    'Public Audit - I' => 'Public Audit - I',
                                    'Public Audit - II' => 'Public Audit - II',
                                    'Public Audit - III' => 'Public Audit - III',
                                ])
                                ->required(),

                            TextInput::make('dalit_female')->label('Dalit Female')->numeric()->required()->default(0),
                            TextInput::make('dalit_male')->label('Dalit Male')->numeric()->required()->default(0),
                            TextInput::make('janjati_female')->label('Janjati Female')->numeric()->required()->default(0),
                            TextInput::make('janjati_male')->label('Janjati Male')->numeric()->required()->default(0),
                            TextInput::make('other_female')->label('Other Female')->numeric()->required()->default(0),
                            TextInput::make('other_male')->label('Other Male')->numeric()->required()->default(0),

                            TextInput::make('total')
                                ->label('Total')
                                ->numeric()
                                ->disabled()
                                ->default(0)
                                ->afterStateUpdated(function ($set, $get) {
                                    $set(
                                        'total',
                                        $get('dalit_female') +
                                        $get('dalit_male') +
                                        $get('janjati_female') +
                                        $get('janjati_male') +
                                        $get('other_female') +
                                        $get('other_male')
                                    );
                                }),
                        ]),
                    ]),
            ]);
    }
}
