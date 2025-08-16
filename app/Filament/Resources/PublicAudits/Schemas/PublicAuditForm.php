<?php

namespace App\Filament\Resources\PublicAudits\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PublicAuditForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_id')
                    ->required()
                    ->numeric(),
                TextInput::make('district'),
                TextInput::make('palika'),
                TextInput::make('donor'),
                TextInput::make('scheme_start_year'),
                TextInput::make('scheme_name'),
                TextInput::make('audit_name'),
                DatePicker::make('audit_date'),
                TextInput::make('df')
                    ->numeric(),
                TextInput::make('dm')
                    ->numeric(),
                TextInput::make('jf')
                    ->numeric(),
                TextInput::make('jm')
                    ->numeric(),
                TextInput::make('of')
                    ->numeric(),
                TextInput::make('om')
                    ->numeric(),
            ]);
    }
}
