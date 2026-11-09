<?php

namespace App\Filament\Resources\DeathRecords\Pages;

use App\Filament\Resources\DeathRecords\DeathRecordResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeathRecords extends ListRecords
{
    protected static string $resource = DeathRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
