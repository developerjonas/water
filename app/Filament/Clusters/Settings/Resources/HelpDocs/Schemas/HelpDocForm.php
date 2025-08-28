<?php

namespace App\Filament\Clusters\Settings\Resources\HelpDocs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HelpDocForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('file_path')
                    ->required(),
                TextInput::make('file_type')
                    ->required(),
                TextInput::make('category'),
            ]);
    }
}
