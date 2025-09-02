<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerStaff\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Partner;

class PartnerStaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('partner_code')
                    ->label('Partner')
                    ->required()
                    ->searchable()
                    ->options(fn () => Partner::pluck('name', 'partner_code')->toArray())
                    ->preload() // Preload for faster searching
                    ->placeholder('Select a Partner'),

                TextInput::make('name')
                    ->required(),

                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required(),

                TextInput::make('phone')
                    ->tel()
                    ->label('Phone Number'),

                TextInput::make('position')
                    ->label('Position'),
            ]);
    }
}
