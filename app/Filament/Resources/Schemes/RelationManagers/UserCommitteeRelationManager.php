<?php

namespace App\Filament\Resources\Schemes\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

// Schema Components
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;

// Table Components
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\AssociateAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;

class UserCommitteeRelationManager extends RelationManager
{
    protected static string $relationship = 'userCommittee';
    protected static ?string $title = 'WUSCs';
    protected static ?string $recordTitleAttribute = 'user_committee_name';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                // This grid creates the 2-column layout
                Grid::make(2)
                    ->schema([
                        // --- LEFT COLUMN ---
                        Section::make('WUSC Details')
                            ->schema([
                                TextInput::make('scheme_code')
                                    ->label('Scheme Code')
                                    ->disabled()
                                    ->dehydrated()
                                    ->hidden(fn () => true), // Still hidden

                                TextInput::make('user_committee_name')
                                    ->label('User Committee Name')
                                    ->required()
                                    ->maxLength(255),
                                
                                DatePicker::make('date_of_formation')
                                    ->label('Date of Formation'),

                                TextInput::make('wusc_registration_status')->label('WUSC Registration Status'),
                                TextInput::make('registration_number')->label('Registration Number'),
                                
                                DatePicker::make('contract_date')->label('Contract Date'),
                                DatePicker::make('contract_expiry_date')->label('Contract Expiry Date'),

                                Textarea::make('remarks')
                                    ->label('Remarks')
                                    ->columnSpanFull(),
                            ]),
                        
                        // --- RIGHT COLUMN ---
                        Grid::make(1) // This grid will stack the sections vertically
                            ->schema([
                                Section::make('Bank Information')
                                    ->schema([
                                        TextInput::make('user_committee_bank_account_name')
                                            ->label('Bank Account Name'),
                                        TextInput::make('user_committee_bank_account_number')
                                            ->label('Bank Account Number'),
                                    ]),

                                Section::make('Key Positions')
                                    ->schema([
                                        // Using a 2-col grid *inside* the section
                                        Grid::make(2)->schema([
                                            TextInput::make('chair_name')->label('Chair Name'),
                                            TextInput::make('chair_contact')->label('Chair Contact'),
                                            TextInput::make('vice_chair_name')->label('Vice Chair Name'),
                                            TextInput::make('vice_chair_contact')->label('Vice Chair Contact'),
                                            TextInput::make('secretary_name')->label('Secretary Name'),
                                            TextInput::make('secretary_contact')->label('Secretary Contact'),
                                            TextInput::make('deputy_secretary_name')->label('Deputy Secretary Name'),
                                            TextInput::make('deputy_secretary_contact')->label('Deputy Secretary Contact'),
                                            TextInput::make('treasurer_name')->label('Treasurer Name'),
                                            TextInput::make('treasurer_contact')->label('Treasurer Contact'),
                                        ])
                                    ]),
                            ]),
                    ]),
                
                // --- FULL WIDTH SECTION (Below the 2 columns) ---
                Section::make('Committee Composition')
                    ->description('Number of members from each group.')
                    ->schema([
                        // We use a 4-column grid here for a table-like layout
                        Grid::make(4)
                            ->schema([
                                // Headers (Disabled text inputs can act as labels)
                                TextInput::make('header_dalit')->label('Dalit')->disabled()->columnSpan(1),
                                TextInput::make('header_janjati')->label('Janjati')->disabled()->columnSpan(1),
                                TextInput::make('header_others')->label('Others')->disabled()->columnSpan(1),
                                TextInput::make('header_blank')->label('Position')->disabled()->columnSpan(1),

                                // Row 1: Female Key
                                TextInput::make('dalit_female_key')->numeric()->default(0)->required(),
                                TextInput::make('janjati_female_key')->numeric()->default(0)->required(),
                                TextInput::make('others_female_key')->numeric()->default(0)->required(),
                                TextInput::make('label_female_key')->label('Female (Key)')->disabled()->dehydrated(false),

                                // Row 2: Male Key
                                TextInput::make('dalit_male_key')->numeric()->default(0)->required(),
                                TextInput::make('janjati_male_key')->numeric()->default(0)->required(),
                                TextInput::make('others_male_key')->numeric()->default(0)->required(),
                                TextInput::make('label_male_key')->label('Male (Key)')->disabled()->dehydrated(false),

                                // Row 3: Female Member
                                TextInput::make('dalit_female_member')->numeric()->default(0)->required(),
                                TextInput::make('janjati_female_member')->numeric()->default(0)->required(),
                                TextInput::make('others_female_member')->numeric()->default(0)->required(),
                                TextInput::make('label_female_member')->label('Female (Member)')->disabled()->dehydrated(false),

                                // Row 4: Male Member
                                TextInput::make('dalit_male_member')->numeric()->default(0)->required(),
                                TextInput::make('janjati_male_member')->numeric()->default(0)->required(),
                                TextInput::make('others_male_member')->numeric()->default(0)->required(),
                                TextInput::make('label_male_member')->label('Male (Member)')->disabled()->dehydrated(false),
                            ])
                    ])
            ]);
    }

    public function infolist(Schema $infolist): Schema
    {
        return $infolist
            ->schema([
                // This grid creates the 2-column layout
                Grid::make(2)
                    ->schema([
                        // --- LEFT COLUMN ---
                        Section::make('WUSC Details')
                            ->schema([
                                TextEntry::make('scheme_code')->label('Scheme Code'),
                                TextEntry::make('user_committee_name')->label('Name'),
                                TextEntry::make('date_of_formation')->date(),
                                TextEntry::make('wusc_registration_status'),
                                TextEntry::make('registration_number'),
                                TextEntry::make('contract_date')->date(),
                                TextEntry::make('contract_expiry_date')->date(),
                            ]),

                        // --- RIGHT COLUMN ---
                        Grid::make(1) // Stacks sections vertically
                            ->schema([
                                Section::make('Bank Information')
                                    ->schema([
                                        TextEntry::make('user_committee_bank_account_name'),
                                        TextEntry::make('user_committee_bank_account_number'),
                                    ]),
                                
                                Section::make('Auditing')
                                    ->schema([
                                        TextEntry::make('created_at')->dateTime(),
                                        TextEntry::make('updated_at')->dateTime(),
                                    ]),
                            ]),
                    ]),

                // --- FULL WIDTH SECTIONS ---
                Section::make('Key Positions')
                    ->schema([
                        Grid::make(4) // 4-column layout for contacts
                            ->schema([
                                TextEntry::make('chair_name'),
                                TextEntry::make('chair_contact'),
                                TextEntry::make('vice_chair_name'),
                                TextEntry::make('vice_chair_contact'),
                                TextEntry::make('secretary_name'),
                                TextEntry::make('secretary_contact'),
                                TextEntry::make('deputy_secretary_name'),
                                TextEntry::make('deputy_secretary_contact'),
                                TextEntry::make('treasurer_name'),
                                TextEntry::make('treasurer_contact'),
                            ])
                    ]),
                
                Section::make('Committee Composition')
                    ->schema([
                        Grid::make(4) // 4-column layout
                            ->schema([
                                // I'm simplifying this for the infolist, 
                                // but you could add labels just like the form if you wish
                                TextEntry::make('dalit_female_key')->label('Dalit Female (Key)')->numeric(),
                                TextEntry::make('dalit_male_key')->label('Dalit Male (Key)')->numeric(),
                                TextEntry::make('dalit_female_member')->label('Dalit Female (Member)')->numeric(),
                                TextEntry::make('dalit_male_member')->label('Dalit Male (Member)')->numeric(),
                                
                                TextEntry::make('janjati_female_key')->label('Janjati Female (Key)')->numeric(),
                                TextEntry::make('janjati_male_key')->label('Janjati Male (Key)')->numeric(),
                                TextEntry::make('janjati_female_member')->label('Janjati Female (Member)')->numeric(),
                                TextEntry::make('janjati_male_member')->label('Janjati Male (Member)')->numeric(),
                                
                                TextEntry::make('others_female_key')->label('Others Female (Key)')->numeric(),
                                TextEntry::make('others_male_key')->label('Others Male (Key)')->numeric(),
                                TextEntry::make('others_female_member')->label('Others Female (Member)')->numeric(),
                                TextEntry::make('others_male_member')->label('Others Male (Member)')->numeric(),
                            ])
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        // --- This table() method is unchanged ---
        return $table
            ->recordTitleAttribute('user_committee_name')
            ->columns([
                TextColumn::make('user_committee_name')
                    ->searchable()
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::Medium),

                TextColumn::make('date_of_formation')
                    ->date()
                    ->sortable(),

                TextColumn::make('chair_name')
                    ->searchable(),

                TextColumn::make('wusc_registration_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'registered' => 'success',
                        'pending'    => 'warning',
                        'default'      => 'gray',
                    }),

                TextColumn::make('contract_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('total_key_members')
                    ->getStateUsing(fn ($record) =>
                        $record->dalit_female_key +
                        $record->dalit_male_key +
                        $record->janjati_female_key +
                        $record->janjati_male_key +
                        $record->others_female_key +
                        $record->others_male_key
                    )
                    ->label('Key Members')
                    ->numeric(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Add filters if needed
            ])
            ->headerActions([
                AssociateAction::make()
                    ->preloadRecordSelect(),

                CreateAction::make()
                    ->label('Add WUSC')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['scheme_code'] = $this->ownerRecord->scheme_code;
                        return $data;
                    }),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['scheme_code'] = $this->ownerRecord->scheme_code;
                        return $data;
                    }),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->where(
                'scheme_code',
                $this->ownerRecord->scheme_code
            ));
    }
}