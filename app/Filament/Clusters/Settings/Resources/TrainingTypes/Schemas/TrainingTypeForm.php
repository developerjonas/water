<?php

namespace App\Filament\Clusters\Settings\Resources\TrainingTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TrainingTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        // Define levels for maintainability
        $levels = [
            'Province' => 'Province Level',
            'Cluster' => 'Cluster Level',
            'District' => 'District Level',
            'Municipality' => 'Municipality Level',
            'Ward' => 'Ward Level',
            'Scheme' => 'Scheme Level',
        ];

        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Training Name')
                    ->placeholder('Enter training type name')
                    ->required(),

                Select::make('level')
                    ->label('Training Level')
                    ->placeholder('Select Level')
                    ->required()
                    ->options($levels),

                Toggle::make('is_active')
                    ->label('Is Active')
                    ->required()
                    ->inline(false),
            ]);
    }
}
