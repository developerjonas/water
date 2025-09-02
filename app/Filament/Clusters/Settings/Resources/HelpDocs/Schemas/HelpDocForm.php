<?php

namespace App\Filament\Clusters\Settings\Resources\HelpDocs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
                    ->label('Title')
                    ->placeholder('Enter help document title')
                    ->required(),

                Textarea::make('description')
                    ->label('Description')
                    ->placeholder('Enter description or notes about this document')
                    ->columnSpanFull(),

                FileUpload::make('file_path')
                    ->label('Upload File')
                    ->required()
                    ->directory('help_docs')
                    ->maxSize(10240) // Max 10 MB
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->helperText('Allowed types: PDF, DOC, DOCX'),

                Select::make('file_type')
                    ->label('File Type')
                    ->required()
                    ->options([
                        'pdf' => 'PDF',
                        'doc' => 'DOC',
                        'docx' => 'DOCX',
                    ])
                    ->default('pdf'),

                TextInput::make('category')
                    ->label('Category')
                    ->placeholder('Enter category (optional)'),
            ]);
    }
}
