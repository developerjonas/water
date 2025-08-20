<?php

namespace App\Filament\Resources\Donors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;

class DonorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Donor Info')
                        ->schema([
                            TextInput::make('name')
                                ->label('Donor Name')
                                ->required(),
                            TextInput::make('contact_person')
                                ->label('Contact Person')
                                ->placeholder('Enter name or JSON array for multiple contacts'),
                            TextInput::make('email')
                                ->label('Email Address')
                                ->email()
                                ->placeholder('example@domain.com'),
                            TextInput::make('phone')
                                ->label('Phone Number')
                                ->tel(),
                        ]),
                    Step::make('Address & Notes')
                        ->schema([
                            TextInput::make('address')
                                ->label('Address'),
                            Textarea::make('remarks')
                                ->label('Remarks')
                                ->columnSpanFull(),
                        ]),
                ]),
            ]);
    }
}
