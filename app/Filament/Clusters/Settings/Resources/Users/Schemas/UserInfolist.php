<?php

namespace App\Filament\Clusters\Settings\Resources\Users\Schemas;

use App\Enums\UserRole;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email')
                            ->label('Email address')
                            ->icon('heroicon-m-envelope'),
                        TextEntry::make('email_verified_at')
                            ->dateTime()
                            ->placeholder('Not verified'),
                        TextEntry::make('created_at')
                            ->dateTime(),
                    ]),

                Section::make('Access & Location')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('role')
                            ->badge()
                            // Ensure we show the Label even if we get a raw string
                            ->formatStateUsing(fn ($state) => $state instanceof UserRole ? $state->getLabel() : UserRole::tryFrom($state)?->getLabel() ?? $state)
                            // Fix: Handle both Enum objects and raw strings to prevent TypeError
                            ->color(function ($state): string {
                                $role = $state instanceof UserRole ? $state : UserRole::tryFrom($state);
                                
                                return match ($role) {
                                    UserRole::ADMIN => 'danger',
                                    UserRole::DISTRICT => 'warning',
                                    UserRole::MUNICIPAL => 'success',
                                    UserRole::VIEW_ONLY => 'gray',
                                    default => 'primary',
                                };
                            }),

                        IconEntry::make('is_active')
                            ->boolean()
                            ->label('Active Status'),

                        // Display Relationship Name instead of Code
                        TextEntry::make('district.name')
                            ->label('District')
                            ->placeholder('Global / Not Assigned'),

                        // Display Relationship Name instead of Code
                        TextEntry::make('municipality.name')
                            ->label('Municipality')
                            ->placeholder('All / Not Assigned'),
                    ]),
            ]);
    }
}