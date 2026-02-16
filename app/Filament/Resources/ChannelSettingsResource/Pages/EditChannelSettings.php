<?php

namespace App\Filament\Resources\ChannelSettingsResource\Pages;

use App\Filament\Resources\ChannelSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChannelSettings extends EditRecord
{
    protected static string $resource = ChannelSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
