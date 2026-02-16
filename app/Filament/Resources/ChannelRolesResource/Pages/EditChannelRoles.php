<?php

namespace App\Filament\Resources\ChannelRolesResource\Pages;

use App\Filament\Resources\ChannelRolesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChannelRoles extends EditRecord
{
    protected static string $resource = ChannelRolesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
