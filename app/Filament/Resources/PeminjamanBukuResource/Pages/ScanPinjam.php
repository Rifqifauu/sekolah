<?php

namespace App\Filament\Resources\PeminjamanBukuResource\Pages;

use App\Filament\Resources\PeminjamanBukuResource;
use Filament\Resources\Pages\Page;

class ScanPinjam extends Page
{
    protected static string $resource = PeminjamanBukuResource::class;

    protected static string $view = 'filament.resources.peminjaman-buku-resource.pages.scan-pinjam';
}
