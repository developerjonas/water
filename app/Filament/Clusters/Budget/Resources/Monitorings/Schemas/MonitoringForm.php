<?php

namespace App\Filament\Clusters\Budget\Resources\Monitorings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use App\Models\Scheme;
use App\Models\Budget;

class MonitoringForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make()
                    ->schema([
                        // Step 1: Select Scheme
                        Step::make('Select Scheme')
                            ->schema([
                                Select::make('scheme_code')
                                    ->label('Scheme')
                                    ->options(fn() => Scheme::pluck('scheme_code', 'scheme_code'))
                                    ->searchable()
                                    ->required()
                                    ->reactive(),
                            ]),

                        // Step 2: Select Budget from that Scheme
                        Step::make('Select Budget')
                            ->schema([
                                Select::make('budget_code')
                                    ->label('Budget')
                                    ->options(function (callable $get) {
                                        $schemeCode = $get('scheme_code');
                                        if (!$schemeCode) {
                                            return [];
                                        }

                                        return Budget::where('scheme_code', $schemeCode)
                                            ->pluck('budget_code', 'budget_code');
                                    })
                                    ->searchable()
                                    ->required()
                                    ->reactive(),
                            ]),

                        // Step 3: Monitoring Details
                        Step::make('Monitoring Details')
                            ->schema([
                                TextInput::make('monitoring_code')
                                    ->label('Monitoring Code')
                                    ->default(fn() => 'MON-' . now()->format('Y') . '-' . strtoupper(uniqid()))
                                    ->readOnly(),

                                DatePicker::make('monitoring_date')
                                    ->label('Monitoring Date')
                                    ->required(),

                                TextInput::make('monitored_by')
                                    ->label('Monitored By')
                                    ->required(),

                                Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'pending' => 'Pending',
                                        'completed' => 'Completed',
                                        'follow-up' => 'Follow-up Required',
                                    ])
                                    ->default('pending')
                                    ->required(),

                                Textarea::make('remarks')
                                    ->label('Remarks')
                                    ->rows(3),

                                FileUpload::make('attachments')
                                    ->label('Attachments')
                                    ->multiple()
                                    ->directory('monitoring-docs')
                                    ->downloadable(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}