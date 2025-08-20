<?php

namespace App\Filament\Resources\Donors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DonorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Donor Name'),

                TextEntry::make('contact_person')
                    ->label('Contact Person(s)')
                    ->formatStateUsing(function ($state) {
                        if (blank($state)) {
                            return 'N/A';
                        }
                        // Decode JSON if stored as array
                        if (is_string($state) && str_starts_with($state, '[')) {
                            $contacts = json_decode($state, true);
                            return implode(', ', $contacts ?: []);
                        }
                        return $state;
                    }),

                TextEntry::make('email')
                    ->label('Email Address'),

                TextEntry::make('phone')
                    ->label('Phone Number'),

                TextEntry::make('address')
                    ->label('Address'),

                TextEntry::make('remarks')
                    ->label('Remarks')
                    ->formatStateUsing(fn($state) => $state ?: 'None'),

                TextEntry::make('deleted_at')
                    ->label('Deleted At')
                    ->dateTime()
                    ->formatStateUsing(fn($state) => $state ?: 'Active'),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(),
            ]);
    }
}
