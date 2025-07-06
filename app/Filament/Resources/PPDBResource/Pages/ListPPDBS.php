<?php

namespace App\Filament\Resources\PPDBResource\Pages;

use App\Filament\Resources\PPDBResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPPDBS extends ListRecords
{
    protected static string $resource = PPDBResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
