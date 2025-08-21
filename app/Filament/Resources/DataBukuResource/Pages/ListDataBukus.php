<?php

namespace App\Filament\Resources\DataBukuResource\Pages;

use App\Filament\Resources\DataBukuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataBukus extends ListRecords
{
    protected static string $resource = DataBukuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
      protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\DataBukuResource\Widgets\StatistikBuku::class,
        ];
    }

}
