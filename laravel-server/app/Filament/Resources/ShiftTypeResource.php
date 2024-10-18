<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShiftTypeResource\Pages;
use App\Models\ShiftType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ShiftTypeResource extends Resource
{
    protected static ?string $model = ShiftType::class;
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->unique(ShiftType::class, 'name', ignoreRecord: true),
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
            'index' => Pages\ListShiftTypes::route('/'),
            'create' => Pages\CreateShiftType::route('/create'),
            'edit' => Pages\EditShiftType::route('/{record}/edit'),
        ];
    }
}
