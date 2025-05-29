<?php

namespace App\Http\Middleware;
  use App\Models\Artikel;
use App\Models\Pengumuman;
use App\Models\PageSetting;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */


public function share(Request $request)
{
    return array_merge(parent::share($request), [
        'flash' => [
            'message' => fn () => $request->session()->get('message'),
        ],

        'popularArticles' => fn () => Artikel::where('status', 'published')
            ->orderByDesc('view_count')
            ->limit(5)
            ->get(),

        'pengumuman' => fn () => Pengumuman::orderByDesc('created_at')
            ->limit(5)
            ->get(),
        'page_setting' => fn () => PageSetting::first(),
        'ekstrakurikuler' => fn () => Ekstrakurikuler::orderByDesc('created_at')
            ->limit(5)
            ->get(),
    ]);
}

}