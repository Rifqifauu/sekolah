<?php

namespace App\Filament\Resources\DataBukuResource\Widgets;

use App\Models\DataBuku;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatistikBuku extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Judul Buku', DataBuku::count())
                ->description('Jumlah judul buku yang tercatat di perpustakaan'),

            Stat::make('Total Eksemplar Buku', DataBuku::sum('jumlah'))
                ->description('Jumlah seluruh buku dari semua judul yang tersedia'),
        ];
    }
}
