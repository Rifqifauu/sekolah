<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GalleryController extends Controller
{
    public function index()
    {
        $galeri = Gallery::with(['images' => function ($query) {
            $query->orderBy('created_at', 'asc')->limit(1);
        }])->orderBy('created_at', 'desc')->get();

        return Inertia::render('Galeri/Index', [
            'galeri' => $galeri,
        ]);
    }
    public function show($id){
    $galeri = Gallery::where('id', $id)->first(); // ambil data galeri
    $images = Image::where('gallery_id', $id)->get(); // kumpulan gambar di galeri itu

    return Inertia::render('Galeri/ShowGallery', [
        'galeri' => $galeri,
        'images' => $images  // ini array koleksi Image
    ]);
}



}
