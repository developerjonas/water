<?php

namespace App\Filament\Resources\UserCommittees\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use App\Filament\Components\SchemeSelector;

class UserCommitteeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    Step::make('Scheme')->columns(3)->schema(SchemeSelector::make()),

                    Step::make('Formation')
                        ->schema([
                            TextInput::make('user_committee_name')
                                ->label('User Committee Name')
                                ->placeholder('Enter the User Committee Name')
                                ->required(),

                            DatePicker::make('date_of_formation')
                                ->label('Date of Formation')
                                ->placeholder('YYYY-MM-DD'),

                            TextInput::make('user_committee_bank_account_name')
                                ->label('UC Bank Account Name')
                                ->placeholder('Enter WUSC bank account name'),

                            TextInput::make('user_committee_bank_account_number')
                                ->label('UC Bank Account Number')
                                ->placeholder('Enter WUSC bank account number'),
                        ]),

                    Step::make('Key Positions')
                        ->columns(2)
                        ->schema([
                            TextInput::make('chair_name')->label('Chair Name')->required(),
                            TextInput::make('chair_contact')->label('Chair Contact')->required(),
                            TextInput::make('vice_chair_name')->label('Vice-Chair Name'),
                            TextInput::make('vice_chair_contact')->label('Vice-Chair Contact'),
                            TextInput::make('secretary_name')->label('Secretary Name'),
                            TextInput::make('secretary_contact')->label('Secretary Contact'),
                            TextInput::make('deputy_secretary_name')->label('Deputy Secretary Name'),
                            TextInput::make('deputy_secretary_contact')->label('Deputy Secretary Contact'),
                            TextInput::make('treasurer_name')->label('Treasurer Name'),
                            TextInput::make('treasurer_contact')->label('Treasurer Contact'),
                        ]),

                    Step::make('Members')
                        ->columns(2)
                        ->schema([

                            Section::make('Dalit Members')->columns(2)
                                ->schema([
                                    TextInput::make('dalit_female_key')->label('Dalit Female Key')->numeric()->default(0),
                                    TextInput::make('dalit_male_key')->label('Dalit Male Key')->numeric()->default(0),
                                    TextInput::make('dalit_female_member')->label('Dalit Female Member')->numeric()->default(0),
                                    TextInput::make('dalit_male_member')->label('Dalit Male Member')->numeric()->default(0),
                                ]),

                            Section::make('Janjati Members')->columns(2)
                                ->schema([
                                    TextInput::make('janjati_female_key')->label('Janjati Female Key')->numeric()->default(0),
                                    TextInput::make('janjati_male_key')->label('Janjati Male Key')->numeric()->default(0),
                                    TextInput::make('janjati_female_member')->label('Janjati Female Member')->numeric()->default(0),
                                    TextInput::make('janjati_male_member')->label('Janjati Male Member')->numeric()->default(0),
                                ]),

                            Section::make('Other Members')->columns(2)
                                ->schema([
                                    TextInput::make('others_female_key')->label('Other Female Key')->numeric()->default(0),
                                    TextInput::make('others_male_key')->label('Other Male Key')->numeric()->default(0),
                                    TextInput::make('others_female_member')->label('Other Female Member')->numeric()->default(0),
                                    TextInput::make('others_male_member')->label('Other Male Member')->numeric()->default(0),
                                ]),
                        ]),

                    Step::make('Registration & Contract')
                        ->schema([
                            Select::make('registration_status')
                                ->label('Registration Status')
                                ->options([
                                    'registered' => 'Registered',
                                    'in_progress' => 'In Progress',
                                    'not_registered' => 'Not Registered',
                                ])
                                ->required(),

                            TextInput::make('registration_number')->label('Registration Number'),

                            DatePicker::make('contract_date')->label('Contract Date')->placeholder('YYYY-MM-DD'),
                            DatePicker::make('contract_expiry_date')->label('Contract Expiry Date')->placeholder('YYYY-MM-DD'),

                            Textarea::make('remarks')
                                ->label('Remarks')
                                ->columnSpanFull()
                                ->placeholder('Any additional notes or remarks'),
                        ]),

                ])->columnSpanFull(),
            ]);
    }
}
