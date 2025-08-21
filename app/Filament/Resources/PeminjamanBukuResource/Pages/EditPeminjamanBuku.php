<?php

namespace App\Filament\Resources\PeminjamanBukuResource\Pages;

use App\Filament\Resources\PeminjamanBukuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeminjamanBuku extends EditRecord
{
    protected static string $resource = PeminjamanBukuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
