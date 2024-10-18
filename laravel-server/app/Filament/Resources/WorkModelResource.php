<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkModelResource\Pages;
use App\Models\WorkModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WorkModelResource extends Resource
{
    protected static ?string $model = WorkModel::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->unique(WorkModel::class, 'name', ignoreRecord: true),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jobPostings.count')
                    ->label('Job Postings')
                    ->counts('jobPostings'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkModels::route('/'),
            'create' => Pages\CreateWorkModel::route('/create'),
            'edit' => Pages\EditWorkModel::route('/{record}/edit'),
        ];
    }
}
