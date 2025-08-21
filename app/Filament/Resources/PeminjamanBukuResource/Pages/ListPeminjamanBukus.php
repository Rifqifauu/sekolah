<?php

namespace App\Filament\Resources\PeminjamanBukuResource\Pages;

use App\Filament\Resources\PeminjamanBukuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeminjamanBukus extends ListRecords
{
    protected static string $resource = PeminjamanBukuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\PeminjamanBukuResource\Widgets\StatistikPeminjaman::class,
        ];
    }
}
