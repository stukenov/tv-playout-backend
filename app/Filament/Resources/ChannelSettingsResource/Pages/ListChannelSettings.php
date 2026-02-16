<?php

namespace App\Filament\Resources\ChannelSettingsResource\Pages;

use App\Filament\Resources\ChannelSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChannelSettings extends ListRecords
{
    protected static string $resource = ChannelSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
