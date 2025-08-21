<?php
use App\Http\Controllers\KatalogController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PerpustakaanController;

// Authentication Routes
Auth::routes();

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home')->withoutMiddleware('auth');
Route::get('/home', [HomeController::class, 'index'])->name('home')->withoutMiddleware('auth');
// Divisi Routes
Route::get( '/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/kontak', function () {
    return Inertia::render('Kontak');
});
Route::get('/struktur-organisasi', function () {
    return Inertia::render('StrukturOrganisasi');
});
Route::get( '/guru', [PeopleController::class, 'guru'])->name('people.guru');
Route::get( '/spmb', [PendaftaranController::class, 'index'])->name('pendaftaran');
Route::get( '/form-pdf/{id}', [PendaftaranController::class, 'generatePDF'])->name('pendaftaran.pdf');
Route::get( '/spmb/formulir', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
Route::post( '/spmb', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get( '/staff', [PeopleController::class, 'staff'])->name('people.staff');
Route::get( '/ekstrakurikuler', [EkskulController::class, 'index'])->name('ekskul.index');
Route::get( '/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::get( '/galeri', [GalleryController::class, 'index'])->name('galeri.index');
Route::get( '/galeri/{id}', [GalleryController::class, 'show'])->name('galeri.show');
Route::get( '/artikel/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::get( '/search', [ArtikelController::class, 'search'])->name('artikel.search');
Route::get( '/pengumuman/{id}', [PengumumanController::class, 'show'])->name('pengumuman.show');
Route::get('/perpustakaan', [PerpustakaanController::class,'index'])->name('perpustakaan.index');
Route::get('/perpustakaan/search', [PerpustakaanController::class, 'search'])->name('perpustakaan.search');
Route::post('pinjam-buku',[PerpustakaanController::class, 'pinjam'])->name('perpustakaan.pinjam');
Route::post('kembalikan-buku',[PerpustakaanController::class, 'kembali'])->name('perpustakaan.kembali');
Route::middleware('auth')->group(function () {

});


Route::get('login', function (){
    return redirect('/admin/login');
});


// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/home');
});
Route::fallback(function () {
    return Inertia::render('404', [
        'user' => Auth::user()
    ])->toResponse(request())->setStatusCode(404);
});



