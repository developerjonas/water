<?php

namespace App\Filament\Resources\PublicAudits\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class PublicAuditInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code')->label('Scheme Code'),
                TextEntry::make('audit_type')->label('Audit Type'),
                TextEntry::make('audit_date')->label('Audit Date')->date(),

                TextEntry::make('participant_counts.dalit_female')->label('Dalit Female')->numeric(),
                TextEntry::make('participant_counts.dalit_male')->label('Dalit Male')->numeric(),
                TextEntry::make('participant_counts.janjati_female')->label('Janjati Female')->numeric(),
                TextEntry::make('participant_counts.janjati_male')->label('Janjati Male')->numeric(),
                TextEntry::make('participant_counts.other_female')->label('Other Female')->numeric(),
                TextEntry::make('participant_counts.other_male')->label('Other Male')->numeric(),
                TextEntry::make('total')->label('Total Participants')->numeric(),


                TextEntry::make('audit_documents')
                    ->label('Uploaded Audit Docs')
                    ->formatStateUsing(fn($state) => self::renderDocuments($state))
                    ->html(),


                TextEntry::make('created_at')->label('Created At')->dateTime(),
                TextEntry::make('updated_at')->label('Updated At')->dateTime(),

            ]);
    }

    protected static function renderDocuments($state): string
    {
        if (blank($state)) {
            return '<span class="text-gray-500">No documents uploaded</span>';
        }

        $files = is_array($state) ? $state : json_decode($state, true);
        if (empty($files)) {
            return '<span class="text-gray-500">No documents uploaded</span>';
        }

        $html = '<div class="grid grid-cols-3 gap-2">';
        foreach ($files as $file) {
            if (is_string($file)) {
                $url = Storage::url($file);
                $html .= '<a href="' . $url . '" target="_blank" class="block border rounded p-1 text-center text-sm text-blue-600 hover:underline">'
                    . basename($file) . '</a>';
            }
        }
        $html .= '</div>';

        return $html;
    }
}
