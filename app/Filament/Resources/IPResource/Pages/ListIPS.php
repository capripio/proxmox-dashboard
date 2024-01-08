<?php

namespace App\Filament\Resources\IPResource\Pages;

use App\Filament\Resources\IPResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIPS extends ListRecords
{
    protected static string $resource = IPResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
