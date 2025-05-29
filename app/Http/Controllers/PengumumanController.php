<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
     public function index()
    {
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->get();
        return Inertia::render('Pengumuman/Index', [
            'pengumuman' => $pengumuman
        ]);
    }
    public function show($id){
         $pengumuman = Pengumuman::where('id', $id)
        ->firstOrFail();
         return Inertia::render('Pengumuman/ShowPengumuman', [
            'showpengumuman' => $pengumuman
        ]);
    } 
}
