<?php

namespace App\Filament\Clusters\Settings\Resources\Partners\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('partner_code')
                    ->label('Partner Code')
                    ->placeholder('Enter unique partner code')
                    ->required()
                    ->unique(ignoreRecord: true), // Prevents duplicate codes during edit

                TextInput::make('name')
                    ->label('Partner Name')
                    ->placeholder('Enter partner name')
                    ->required(),

                TextInput::make('email')
                    ->label('Email Address')
                    ->placeholder('Enter partner email')
                    ->email()
                    ->required(),

                TextInput::make('address')
                    ->label('Address')
                    ->placeholder('Enter partner address'),

                TextInput::make('contact_number')
                    ->label('Contact Number')
                    ->placeholder('Enter phone number'),

                TextInput::make('contact_person')
                    ->label('Contact Person')
                    ->placeholder('Enter name of contact person'),
            ]);
    }
}
