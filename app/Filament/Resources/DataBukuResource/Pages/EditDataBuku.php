<?php

namespace App\Filament\Resources\DataBukuResource\Pages;

use App\Filament\Resources\DataBukuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataBuku extends EditRecord
{
    protected static string $resource = DataBukuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
