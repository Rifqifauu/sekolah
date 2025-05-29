<?php

namespace App\Filament\Resources\PageSettingsResource\Pages;

use App\Filament\Resources\PageSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPageSettings extends ListRecords
{
    protected static string $resource = PageSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
        
    }
}
