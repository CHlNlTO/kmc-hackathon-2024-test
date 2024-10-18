<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobPostingStatusResource\Pages;
use App\Models\JobPostingStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobPostingStatusResource extends Resource
{
    protected static ?string $model = JobPostingStatus::class;
    protected static ?string $navigationIcon = 'heroicon-o-bookmark';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->unique(JobPostingStatus::class, 'name', ignoreRecord: true),
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
            'index' => Pages\ListJobPostingStatuses::route('/'),
            'create' => Pages\CreateJobPostingStatus::route('/create'),
            'edit' => Pages\EditJobPostingStatus::route('/{record}/edit'),
        ];
    }
}
