<?php

namespace App\Filament\Widgets;

use App\Models\Artikel;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MonthlyArticlesChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Artikel per Bulan (12 Bulan Terakhir)';
    protected int | string | array $columnSpan = 2;

    protected function getData(): array
    {
        $now = Carbon::now();
        $start = $now->copy()->subMonths(11)->startOfMonth();

        // Ambil data artikel per bulan selama 12 bulan terakhir
        $articlesPerMonth = Artikel::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->where('status', 'published')
            ->where('created_at', '>=', $start)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Generate label bulan dari 12 bulan terakhir
        $labels = [];
        $data = [];

        for ($i = 0; $i < 12; $i++) {
            $month = $start->copy()->addMonths($i);
            $label = $month->translatedFormat('M Y'); // e.g. "Jan 2024"
            $key = $month->format('Y-m'); // untuk dicocokkan dengan hasil query
            $labels[] = $label;
            $data[] = $articlesPerMonth[$key] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Artikel',
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.7)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
