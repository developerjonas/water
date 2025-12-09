<?php

namespace App\Filament\Resources\PublicAudits\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Support\Enums\FontWeight;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class PublicAuditInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                // --- 1. SCHEME & AUDIT IDENTITY (GPS Style Top Section) ---
                Section::make('Scheme & Audit Context')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('scheme.scheme_name')
                            ->label('Scheme Name')
                            ->icon('heroicon-m-home-modern')
                            ->weight(FontWeight::Bold),

                        TextEntry::make('scheme_code')
                            ->label('System Code')
                            ->icon('heroicon-m-hashtag'),

                        TextEntry::make('audit_type')
                            ->label('Audit Type')
                            ->badge()
                            ->color('info')
                            ->icon('heroicon-m-clipboard-document-check'),
                    ]),

                // --- 2. PARTICIPATION MATRIX (Core Info) ---
                Section::make('Participation Demographics')
                    ->description('Breakdown of participants by ethnicity and gender.')
                    ->icon('heroicon-m-users')
                    ->columns(2) // Split into Data Grid vs Total Box
                    ->schema([
                        
                        // Left Side: The Data Matrix
                        Group::make()->schema([
                            Grid::make(3)->schema([
                                // Headers
                                TextEntry::make('Label')->state('Dalit')->weight('bold')->color('gray'),
                                TextEntry::make('Label')->state('Janjati')->weight('bold')->color('gray'),
                                TextEntry::make('Label')->state('Others')->weight('bold')->color('gray'),

                                // Dalit Stats
                                TextEntry::make('participant_counts.dalit_female')
                                    ->label('Female')
                                    ->icon('heroicon-m-user')
                                    ->numeric(),
                                TextEntry::make('participant_counts.janjati_female')
                                    ->label('Female')
                                    ->icon('heroicon-m-user')
                                    ->numeric(),
                                TextEntry::make('participant_counts.other_female')
                                    ->label('Female')
                                    ->icon('heroicon-m-user')
                                    ->numeric(),

                                // Male Stats
                                TextEntry::make('participant_counts.dalit_male')
                                    ->label('Male')
                                    ->icon('heroicon-m-user')
                                    ->numeric(),
                                TextEntry::make('participant_counts.janjati_male')
                                    ->label('Male')
                                    ->icon('heroicon-m-user')
                                    ->numeric(),
                                TextEntry::make('participant_counts.other_male')
                                    ->label('Male')
                                    ->icon('heroicon-m-user')
                                    ->numeric(),
                            ]),
                        ])->columnSpan(1),

                        // Right Side: The Grand Total (Calculated On-The-Fly)
                        Group::make()->schema([
                            Section::make('Total Headcount')
                                ->compact()
                                ->schema([
                                    TextEntry::make('total')
                                        ->hiddenLabel()
                                        ->weight(FontWeight::Black)
                                        ->color('success')
                                        ->alignCenter()
                                        // FIX: Calculate Sum Manually if DB is 0/Null
                                        ->state(function ($record) {
                                            $counts = $record->participant_counts ?? [];
                                            $sum = 0;
                                            foreach($counts as $val) { $sum += (int)$val; }
                                            return $sum; 
                                        }),
                                        
                                    TextEntry::make('audit_date')
                                        ->label('Conducted On')
                                        ->date('d M, Y')
                                        ->alignCenter()
                                        ->badge()
                                        ->color('gray'),
                                ]),
                        ])->columnSpan(1),
                    ]),

                // --- 3. EVIDENCE (GPS Photo Style) ---
                Section::make('Visual Evidence & Documents')
                    ->icon('heroicon-m-camera')
                    ->collapsible()
                    ->schema([
                        // Try ImageEntry first (Best for "Photo Render")
                        ImageEntry::make('audit_documents')
                            ->label('Scanned Documents (Preview)')
                            ->disk('public')
                            ->columnSpanFull()
                            ->height(200)
                            ->limit(3),

                    ]),

                // --- 4. META NOTES ---
                Section::make('Additional Notes')
                    ->icon('heroicon-m-pencil-square')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('remarks') // Assuming you have a remarks field, if not remove
                            ->placeholder('No additional remarks.')
                            ->columnSpanFull(),
                        
                        Grid::make(2)->schema([
                            TextEntry::make('created_at')->dateTime(),
                            TextEntry::make('updated_at')->dateTime(),
                        ]),
                    ]),
            ]);
    }

    /**
     * Helper to render clickable links for files that aren't images
     */
    protected static function renderFileLinks($state): string
    {
        if (blank($state)) return '';
        $files = is_array($state) ? $state : json_decode($state, true);
        if (empty($files)) return '';

        $html = '<div class="flex flex-wrap gap-2 mt-2">';
        foreach ($files as $file) {
            if (is_string($file)) {
                $url = Storage::url($file);
                $name = basename($file);
                $icon = str_ends_with(strtolower($file), '.pdf') 
                    ? '<span class="text-red-500 font-bold">PDF</span>' 
                    : '<span class="text-blue-500 font-bold">FILE</span>';

                $html .= "<a href='{$url}' target='_blank' class='inline-flex items-center gap-2 px-3 py-1 bg-gray-50 border border-gray-200 rounded hover:bg-gray-100 text-sm'>
                            {$icon} <span class='truncate max-w-xs'>{$name}</span>
                          </a>";
            }
        }
        $html .= '</div>';
        return $html;
    }
}