<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Artikel;
use App\Models\People;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function index()
{
    $user = Auth::user();

    $pengumuman = Pengumuman::orderBy('created_at', 'desc')->take(2)->get()->map(function ($pengumuman) {
        $pengumuman->created_at_formatted = $pengumuman->created_at->format('d M Y');
        return $pengumuman;
    });

    $popularArticles = Artikel::orderBy('view_count', 'desc')
        ->take(3)
        ->get();
    $siswa = People::where('tipe','siswa')->count();
    $guru = People::where('tipe','guru')->count();
    $staf = People::where('tipe','staf')->count();

    return Inertia::render('Home', [
        'user' => $user,
        'guru' => $guru,
        'siswa' => $siswa,
        'staf' => $staf,
        'popularArticles' => $popularArticles,
        'title' => 'Home',
        'pengumuman' => $pengumuman,
    ]);
}
}

