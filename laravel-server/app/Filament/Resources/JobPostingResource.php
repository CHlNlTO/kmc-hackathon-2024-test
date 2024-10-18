<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobPostingResource\Pages;
use App\Models\JobPosting;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobPostingResource extends Resource
{
    protected static ?string $model = JobPosting::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Job Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Job Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Job Title')
                            ->maxLength(255)
                            ->inlineLabel(),
                        Forms\Components\TextInput::make('job_id')
                            ->label('Job ID')
                            ->disabled()
                            ->dehydrated(false)
                            ->visible(fn($record) => $record && $record->exists)
                            ->inlineLabel(),
                        Grid::make()
                            ->schema([
                                Forms\Components\RichEditor::make('description')
                                    ->columnSpan(1 / 2)
                                    ->extraAttributes(['style' => 'max-height: 300px; overflow-y: auto;']),
                            ]),
                        Forms\Components\TextInput::make('salary')
                            ->numeric()
                            ->prefix('₱')->inlineLabel(),
                        Forms\Components\TextInput::make('location')->inlineLabel(),
                        Forms\Components\DatePicker::make('application_deadline')->inlineLabel(),
                        Forms\Components\Select::make('job_type_id')
                            ->relationship('jobType', 'name')->inlineLabel(),
                        Forms\Components\Select::make('work_model_id')
                            ->relationship('workModel', 'name')->inlineLabel(),
                        Forms\Components\Select::make('shift_type_id')
                            ->relationship('shiftType', 'name')->inlineLabel(),
                        Forms\Components\Select::make('status_id')
                            ->relationship('status', 'name')->inlineLabel(),
                        Forms\Components\Select::make('skills')
                            ->multiple()
                            ->relationship('skills', 'name')
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->unique(Skill::class, 'name')
                                    ->maxLength(255),
                            ])->inlineLabel(),
                    ])
                    ->columns(2)
                    ->compact(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('job_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('salary')
                    ->money('PHP'),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('application_deadline')
                    ->date(),
                Tables\Columns\TextColumn::make('status.name'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobPostings::route('/'),
            'create' => Pages\CreateJobPosting::route('/create'),
            'edit' => Pages\EditJobPosting::route('/{record}/edit'),
        ];
    }
}
