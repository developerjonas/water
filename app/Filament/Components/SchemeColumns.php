<?php

namespace App\Filament\Components;

use Filament\Tables\Columns\TextColumn;

class SchemeColumns
{
    /**
     * Returns an array of Filament TextColumns for Scheme info
     */
    public static function make(): array
    {
        return [
            TextColumn::make('scheme.province')
                ->label('Province')
                ->searchable()
                ->sortable(),
            TextColumn::make('scheme.district')
                ->label('District')
                ->searchable()
                ->sortable(),
            TextColumn::make('scheme.mun')
                ->label('Municipality')
                ->searchable()
                ->sortable(),
            TextColumn::make('scheme.scheme_name')
                ->label('Scheme Name')
                ->searchable()
                ->sortable(),
        ];
    }
}
