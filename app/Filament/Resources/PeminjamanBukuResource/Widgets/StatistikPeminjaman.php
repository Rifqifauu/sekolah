<?php

namespace App\Filament\Resources\PeminjamanBukuResource\Widgets;

use App\Models\DataBuku;
use App\Models\Peminjaman;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatistikPeminjaman extends BaseWidget
{
    protected function getStats(): array
    {
        return [
             Stat::make('Total Pinjam', Peminjaman::where('tanggal_pinjam', Carbon::today())->count())
                ->description('Jumlah peminjaman buku yang tercatat hari ini'),
             Stat::make('Baru Kembali', Peminjaman::where('tanggal_pinjam', Carbon::today())->count())
                ->description('Jumlah buku yang baru saja dikembalikan hari ini'),
             Stat::make('Jatuh Tempo Hari Ini', Peminjaman::where('tanggal_kembali', Carbon::today())->where('status','dipinjam')->count())
                ->description('Jumlah buku belum kembali yang jatuh tempo hari ini'),
        ];
    }
}
