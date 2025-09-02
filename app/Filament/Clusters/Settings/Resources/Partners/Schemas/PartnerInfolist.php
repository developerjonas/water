<?php

namespace App\Filament\Clusters\Settings\Resources\Partners\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PartnerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('partner_code')
                    ->label('Partner Code'),

                TextEntry::make('name')
                    ->label('Partner Name'),

                TextEntry::make('email')
                    ->label('Email')
                    ->url(fn ($state) => 'mailto:' . $state, true) // Makes it clickable
                    ->copyable(), // Allows quick copy

                TextEntry::make('address')
                    ->label('Address'),

                TextEntry::make('contact_number')
                    ->label('Contact Number'),

                TextEntry::make('contact_person')
                    ->label('Contact Person'),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(),
            ]);
    }
}
