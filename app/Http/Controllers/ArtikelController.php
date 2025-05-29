<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Pengumuman;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::where('status', 'published')
            ->orderBy('published_at', 'desc')->get();
        return Inertia::render('Artikel/Index', [
            'artikels' => $artikels
        ]);
    }
    public function search(Request $request)
{
    $query = $request->input('q');

    $artikels = Artikel::where('status', 'published')
        ->where(function($q) use ($query) {
            $q->where('judul', 'like', '%' . $query . '%')
              ->orWhere('isi', 'like', '%' . $query . '%');
        })
        ->orderBy('published_at', 'desc')
        ->get();

    return Inertia::render('Artikel/SearchResult', [
        'artikels' => $artikels,
        'query' => $query,
    ]);
}

public function show($slug)
{
    $artikel = Artikel::where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();

    // Cache key unik berdasarkan artikel id + user ip (atau user id jika login)
    $userIdentifier = request()->ip();
    $cacheKey = "artikel_viewed_{$artikel->id}_{$userIdentifier}";

    if (! Cache::has($cacheKey)) {
        $artikel->increment('view_count');
        Cache::put($cacheKey, true, now()->addMinutes(30));
    }


    return Inertia::render('Artikel/ShowArtikel', [
        'artikel' => $artikel,
    ]);
}


}
