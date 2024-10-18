<?php

namespace App\Filament\Resources\WorkModelResource\Pages;

use App\Filament\Resources\WorkModelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkModel extends EditRecord
{
    protected static string $resource = WorkModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
