<?php

namespace App\Filament\Resources\UserCommittees\Tables;

use App\Filament\Components\SchemeColumns;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Actions\Pdf\UserCommitteeReportGenerator;
use App\Models\UserCommittee;

class UserCommitteesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(array_merge(
                SchemeColumns::make(),
                [
                    TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ]
            ))
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                Action::make('download_report')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function (UserCommittee $record) {
                        return app(UserCommitteeReportGenerator::class, ['committee' => $record])->streamPdf();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
