<?php

namespace App\Filament\Resources\ProxmoxServerResource\Pages;

use App\Filament\Resources\ProxmoxServerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProxmoxServer extends EditRecord
{
    protected static string $resource = ProxmoxServerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
