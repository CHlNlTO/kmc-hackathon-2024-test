<?php

namespace App\Filament\Resources\JobPostingStatusResource\Pages;

use App\Filament\Resources\JobPostingStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobPostingStatuses extends ListRecords
{
    protected static string $resource = JobPostingStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
