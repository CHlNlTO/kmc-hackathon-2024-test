<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationStatusResource\Pages;
use App\Models\ApplicationStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ApplicationStatusResource extends Resource
{
    protected static ?string $model = ApplicationStatus::class;
    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->unique(ApplicationStatus::class, 'name', ignoreRecord: true),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('applications.count')
                    ->label('Applications')
                    ->counts('applications'),
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
            'index' => Pages\ListApplicationStatuses::route('/'),
            'create' => Pages\CreateApplicationStatus::route('/create'),
            'edit' => Pages\EditApplicationStatus::route('/{record}/edit'),
        ];
    }
}
