<?php

namespace App\Filament\Resources\VirtualMachineResource\Pages;

use App\Filament\Resources\VirtualMachineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVirtualMachines extends ListRecords
{
    protected static string $resource = VirtualMachineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
