<?php

namespace App\Filament\Resources\UserCommittees\Schemas;

use App\Filament\Components\SchemeSelector;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserCommitteeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                // --- Top: Scheme Context ---
                Section::make('Scheme Association')
                    ->icon('heroicon-m-link')
                    ->compact()
                    ->columns(3)
                    ->schema(
                        SchemeSelector::make() 
                    )
                    ->columnSpanFull(),

                // --- Main Content (3 Cols) ---
                Group::make()
                    ->columnSpan(['lg' => 3])
                    ->schema([
                        
                        // 1. General Info
                        Section::make('Committee Details & Banking')
                            ->icon('heroicon-m-building-library')
                            ->columns(2)
                            ->schema([
                                TextInput::make('user_committee_name')
                                    ->label('Committee Name')
                                    ->required()
                                    ->columnSpanFull(),
                                
                                DatePicker::make('date_of_formation')
                                    ->label('Formation Date')
                                    ->native(false),

                                TextInput::make('user_committee_bank_name')
                                    ->label('Bank Name')
                                    ->placeholder('e.g. Rastriya Banijya Bank'),

                                TextInput::make('user_committee_bank_account_name')
                                    ->label('Bank Name')
                                    ->placeholder('e.g. Something Committee'),

                                TextInput::make('user_committee_bank_account_number')
                                    ->label('Bank Account Number'),
                            ]),

                        // 2. Key Positions (High Density Grid)
                        Section::make('Executive Body (Key Positions)')
                            ->icon('heroicon-m-user-group')
                            ->description('Contact details for key committee members.')
                            ->columns(2)
                            ->schema([
                                // Chair
                                TextInput::make('chair_name')->label('Chairperson Name')->required(),
                                TextInput::make('chair_contact')->label('Chairperson Contact')->tel()->required(),

                                // Vice Chair
                                TextInput::make('vice_chair_name')->label('Vice-Chair Name')->required(),
                                TextInput::make('vice_chair_contact')->label('Vice-Chair Contact')->tel()->required(),

                                // Secretary
                                TextInput::make('secretary_name')->label('Secretary Name')->required(),
                                TextInput::make('secretary_contact')->label('Secretary Contact')->tel()->required(),

                                // Deputy Secretary
                                TextInput::make('deputy_secretary_name')->label('Deputy Secretary Name')->required(),
                                TextInput::make('deputy_secretary_contact')->label('Deputy Sec. Contact')->tel()->required(),

                                // Treasurer
                                TextInput::make('treasurer_name')->label('Treasurer Name')->required(),
                                TextInput::make('treasurer_contact')->label('Treasurer Contact')->tel()->required(),
                            ]),

                        // 3. Demographics Matrix
                        Section::make('Committee Composition')
                            ->icon('heroicon-m-chart-bar')
                            ->description('Breakdown by ethnicity and position type.')
                            ->schema([
                                // Dalit Row
                                Grid::make(4)->schema([
                                    TextInput::make('dalit_female_key')->label('Dalit Female (Key)')->numeric()->default(0),
                                    TextInput::make('dalit_male_key')->label('Dalit Male (Key)')->numeric()->default(0),
                                    TextInput::make('dalit_female_member')->label('Dalit Female (Mem)')->numeric()->default(0),
                                    TextInput::make('dalit_male_member')->label('Dalit Male (Mem)')->numeric()->default(0),
                                ]),
                                // Janajati Row
                                Grid::make(4)->schema([
                                    TextInput::make('janjati_female_key')->label('Janajati Female (Key)')->numeric()->default(0),
                                    TextInput::make('janjati_male_key')->label('Janajati Male (Key)')->numeric()->default(0),
                                    TextInput::make('janjati_female_member')->label('Janajati Female (Mem)')->numeric()->default(0),
                                    TextInput::make('janjati_male_member')->label('Janajati Male (Mem)')->numeric()->default(0),
                                ]),
                                // Others Row
                                Grid::make(4)->schema([
                                    TextInput::make('others_female_key')->label('Other Female (Key)')->numeric()->default(0),
                                    TextInput::make('others_male_key')->label('Other Male (Key)')->numeric()->default(0),
                                    TextInput::make('others_female_member')->label('Other Female (Mem)')->numeric()->default(0),
                                    TextInput::make('others_male_member')->label('Other Male (Mem)')->numeric()->default(0),
                                ]),
                            ]),
                    ]),

                // --- Sidebar (1 Col) ---
                Group::make()
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        
                        // 1. Legal Status
                        Section::make('Legal Status')
                            ->icon('heroicon-m-scale')
                            ->schema([
                                Select::make('registration_status')
                                    ->options([
                                        'registered' => 'Registered',
                                        'in_progress' => 'In Progress',
                                        'not_registered' => 'Not Registered',
                                    ])
                                    ->required(),

                                TextInput::make('registration_number')
                                    ->label('Reg. Number'),


                                DatePicker::make('contract_date')
                                    ->label('Contract Date')
                                    ->native(false),
                                
                                DatePicker::make('contract_expiry_date')
                                    ->label('Expiry Date')
                                    ->native(false),
                            ]),

                        // 2. Notes
                        Section::make('Notes')
                            ->icon('heroicon-m-document-text')
                            ->schema([
                                Textarea::make('remarks')
                                    ->rows(5)
                                    ->placeholder('Additional notes...'),
                            ]),
                    ]),

            ])->columns(4);
    }
}