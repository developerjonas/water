<?php

namespace App\Filament\Clusters\Settings\Resources\TrainingTypes\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TrainingTypeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        // Map level codes to human-readable labels
        $levelLabels = [
            'Province' => 'Province Level',
            'Cluster' => 'Cluster Level',
            'District' => 'District Level',
            'Municipality' => 'Municipality Level',
            'Ward' => 'Ward Level',
            'Scheme' => 'Scheme Level',
        ];

        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Training Name'),

                TextEntry::make('level')
                    ->label('Training Level')
                    ->formatStateUsing(fn ($state) => $levelLabels[$state] ?? $state),

                IconEntry::make('is_active')
                    ->label('Active')
                    ->boolean(),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(),
            ]);
    }
}
