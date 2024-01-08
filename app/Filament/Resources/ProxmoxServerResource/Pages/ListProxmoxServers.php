<?php

namespace App\Filament\Resources\ProxmoxServerResource\Pages;

use App\Filament\Resources\ProxmoxServerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProxmoxServers extends ListRecords
{
    protected static string $resource = ProxmoxServerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
