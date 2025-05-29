<?php

namespace App\Filament\Resources\ArtikelResource\Pages;

use App\Filament\Resources\ArtikelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArtikel extends EditRecord
{
    protected static string $resource = ArtikelResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
    protected function getCancelButtonUrl(): string
{
    // Ganti URL ini sesuai kebutuhan, misal ke dashboard atau halaman lain
    return route('/admin'); // Contoh ke route bernama 'dashboard'
    
    // Atau ke halaman list resource:
    // return $this->getResource()::getUrl('index');
}
}
