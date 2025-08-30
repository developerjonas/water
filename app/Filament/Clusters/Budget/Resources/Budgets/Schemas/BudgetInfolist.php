<?php

namespace App\Filament\Clusters\Budget\Resources\Budgets\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class BudgetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            // Basic Info
            Grid::make(2)->schema([
                TextEntry::make('scheme_code')->label('Scheme Code'),
                TextEntry::make('budget_code')->label('Budget Code'),
            ]),

            Grid::make(2)->schema([
                TextEntry::make('created_at')->label('Created At')->dateTime(),
                TextEntry::make('updated_at')->label('Updated At')->dateTime(),
            ]),

            // Budget Summary Table
            Grid::make(3)->schema([
                // Header row (using placeholders for labels)
                TextEntry::make('header_contribution')->label('Contribution'),
                TextEntry::make('header_estimated')->label('Estimated'),
                TextEntry::make('header_actual')->label('Actual'),

                // Helvetas Cash
                TextEntry::make('helvetas_cash_label'),
                TextEntry::make('helvetas_cash_estimated'),
                TextEntry::make('helvetas_cash_actual'),

                // Helvetas Kind
                TextEntry::make('helvetas_kind_label'),
                TextEntry::make('helvetas_kind_estimated'),
                TextEntry::make('helvetas_kind_actual'),

                // Helvetas Total
                TextEntry::make('helvetas_total_label'),
                TextEntry::make('helvetas_total_estimated'),
                TextEntry::make('helvetas_total_actual'),

                // Users
                TextEntry::make('users_label'),
                TextEntry::make('users_estimated'),
                TextEntry::make('users_actual'),

                // Individual Private Tap
                TextEntry::make('private_tap_label'),
                TextEntry::make('individual_private_tap_estimated'),
                TextEntry::make('individual_private_tap_actual'),

                // Palika
                TextEntry::make('palika_label'),
                TextEntry::make('palika_estimated'),
                TextEntry::make('palika_actual'),

                // Total
                TextEntry::make('total_label'),
                TextEntry::make('total_estimated'),
                TextEntry::make('total_actual'),
            ]),
        ]);
    }
}
