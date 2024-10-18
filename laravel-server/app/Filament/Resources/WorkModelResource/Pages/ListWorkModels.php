<?php

namespace App\Filament\Resources\WorkModelResource\Pages;

use App\Filament\Resources\WorkModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkModels extends ListRecords
{
    protected static string $resource = WorkModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
