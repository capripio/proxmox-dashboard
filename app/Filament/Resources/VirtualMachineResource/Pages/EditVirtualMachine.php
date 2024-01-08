<?php

namespace App\Filament\Resources\VirtualMachineResource\Pages;

use App\Filament\Resources\VirtualMachineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVirtualMachine extends EditRecord
{
    protected static string $resource = VirtualMachineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
