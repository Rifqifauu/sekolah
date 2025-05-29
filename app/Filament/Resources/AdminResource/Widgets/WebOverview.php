<?php

namespace App\Filament\Widgets;

use App\Models\Artikel;
use App\Models\Gallery;
use App\Models\People;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WebOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Artikel', Artikel::where('status', 'published')->count())
                ->description('Artikel terbit di sistem')
                ->icon('heroicon-o-academic-cap')
                ->color('success')
                ->extraAttributes(['class' => 'bg-green-100 ']),

            Stat::make('Total Views', Artikel::where('status', 'published')->sum('view_count'))
                ->description('Jumlah total artikel dibaca')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->extraAttributes(['class' => 'bg-blue-100 ']),

            Stat::make('Galeri', Gallery::count())
                ->description('Jumlah total galeri')
                ->icon('heroicon-o-photo')
                ->color('warning')
                ->extraAttributes(['class' => 'bg-yellow-100 ']),

            Stat::make('Jumlah Guru', People::where('tipe', 'guru')->count())
                ->description('Jumlah guru terdaftar')
                ->icon('heroicon-o-user-group')
                ->color('primary')
                ->extraAttributes(['class' => 'bg-purple-100 ']),

            Stat::make('Jumlah Siswa', People::where('tipe', 'siswa')->count())
                ->description('Jumlah siswa terdaftar')
                ->icon('heroicon-o-user-group')
                ->color('secondary')
                ->extraAttributes(['class' => 'bg-pink-100 ']),

            Stat::make('Jumlah Staf', People::where('tipe', 'staf')->count())
                ->description('Jumlah staf terdaftar')
                ->icon('heroicon-o-user-group')
                ->color('success')
                ->extraAttributes(['class' => 'bg-indigo-100 ']),
        ];
    }
}
