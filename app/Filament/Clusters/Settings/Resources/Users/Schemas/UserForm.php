<?php

namespace App\Filament\Clusters\Settings\Resources\Users\Schemas;

use App\Enums\UserRole;
use App\Models\Municipality;
use App\Models\District;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Details')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        DateTimePicker::make('email_verified_at')
                            ->label('Verified At')
                            ->visible(fn() => auth()->user()?->isAdmin()),

                        TextInput::make('password')
                            ->password()
                            ->required(fn($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                            ->dehydrated(fn($state) => filled($state))
                            ->label('Password'),
                    ])->columns(2),

                Section::make('Access Control')
                    ->columnSpanFull()
                    ->schema([
                        // 1. Role Selection (Logic Removed)
                        Select::make('role')
                            ->options(UserRole::class)
                            ->default(UserRole::VIEW_ONLY)
                            ->required(),

                        // 2. District Selection (Always Visible)
                        Select::make('district_code')
                            ->label('District')
                            ->options(District::pluck('name', 'district_code'))
                            ->searchable()
                            ->preload()
                            ->live(), // Kept live only to update Municipality options

                        // 3. Municipality Selection (Always Visible)
                        Select::make('municipality_code')
                            ->label('Municipality')
                            ->options(function ($get) {
                                $districtCode = $get('district_code');
                                
                                if (!$districtCode) {
                                    return [];
                                }

                                return Municipality::where('district_code', $districtCode)
                                    ->pluck('name', 'municipality_code');
                            })
                            ->searchable()
                            ->preload(),

                        Toggle::make('is_active')
                            ->label('Active Account')
                            ->default(true)
                            ->required(),
                    ])->columns(2),
            ]);
    }
}