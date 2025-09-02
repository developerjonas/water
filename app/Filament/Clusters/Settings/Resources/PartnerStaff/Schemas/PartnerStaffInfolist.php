<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerStaff\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use App\Models\Partner;

class PartnerStaffInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('partner_code')
                    ->label('Partner')
                    ->formatStateUsing(fn ($state) => 
                        Partner::where('partner_code', $state)->value('name') ?? $state
                    ), // Show partner name instead of raw code

                TextEntry::make('name')
                    ->label('Staff Name'),

                TextEntry::make('email')
                    ->label('Email Address')
                    ->url(fn ($state) => 'mailto:' . $state, true)
                    ->copyable(),

                TextEntry::make('phone')
                    ->label('Phone Number')
                    ->url(fn ($state) => 'tel:' . $state, true),

                TextEntry::make('position')
                    ->label('Position'),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(),
            ]);
    }
}
