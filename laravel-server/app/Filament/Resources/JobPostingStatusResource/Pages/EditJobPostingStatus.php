<?php

namespace App\Filament\Resources\JobPostingStatusResource\Pages;

use App\Filament\Resources\JobPostingStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobPostingStatus extends EditRecord
{
    protected static string $resource = JobPostingStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
