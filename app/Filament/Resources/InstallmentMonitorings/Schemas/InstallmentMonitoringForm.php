<?php

namespace App\Filament\Resources\InstallmentMonitorings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InstallmentMonitoringForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_id')
                    ->required()
                    ->numeric(),
                Select::make('installment_number')
                    ->options([1 => '1', '2', '3'])
                    ->default('1')
                    ->required(),
                DatePicker::make('installment_date')
                    ->required(),
                TextInput::make('installment_amount')
                    ->required()
                    ->numeric(),
                Select::make('monitoring_type')
                    ->options([
            'Monitoring I' => 'Monitoring i',
            'Monitoring II' => 'Monitoring i i',
            'Monitoring III' => 'Monitoring i i i',
            'Monitoring IV' => 'Monitoring i v',
        ]),
                DatePicker::make('monitoring_date'),
            ]);
    }
}
