<?php

namespace App\Filament\Resources\PPDBResource\Pages;

use App\Filament\Resources\PPDBResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPPDB extends EditRecord
{
    protected static string $resource = PPDBResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
