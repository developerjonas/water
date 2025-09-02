<?php

namespace App\Filament\Clusters\Settings\Resources\Donors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DonorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('donor_code')
                    ->label('Donor Code')
                    ->placeholder('Enter unique donor code')
                    ->required()
                    ->unique(ignoreRecord: true), // ensures no duplicates

                TextInput::make('name')
                    ->label('Donor Name')
                    ->placeholder('Enter donor name')
                    ->required(),

                TextInput::make('contact_person')
                    ->label('Contact Person')
                    ->placeholder('Enter contact person name'),

                TextInput::make('email')
                    ->label('Email Address')
                    ->placeholder('Enter donor email')
                    ->email(),

                TextInput::make('phone')
                    ->label('Phone Number')
                    ->placeholder('Enter contact number')
                    ->tel(),

                TextInput::make('address')
                    ->label('Address')
                    ->placeholder('Enter address'),

                Textarea::make('remarks')
                    ->label('Remarks')
                    ->columnSpanFull()
                    ->placeholder('Any additional notes or remarks'),
            ]);
    }
}
