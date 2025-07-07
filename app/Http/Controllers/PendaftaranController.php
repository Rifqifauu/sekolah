<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    //
    public function index(){
        return Inertia::render('PPDB/Index');
    }
    public function create(){
        return Inertia::render('PPDB/Daftar');
    }
   public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nisn' => 'required|string|unique:pendaftaran,nisn',
        'alamat' => 'required|string',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'tanggal_lahir' => 'required|date',
        'asal_sekolah' => 'required|string|max:255',
        'nama_ortu' => 'required|string|max:255',
        'hp_ortu' => 'required|string|max:20',
        'dokumen' => 'required|file|mimes:pdf',
    ]);

    $path = $request->file('dokumen')->store('dokumen_ppdb');

    Pendaftaran::create([
        'nama' => $validated['nama'],
        'email' => $validated['email'],
        'nisn' => $validated['nisn'],
        'alamat' => $validated['alamat'],
        'jenis_kelamin' => $validated['jenis_kelamin'],
        'tanggal_lahir' => $validated['tanggal_lahir'],
        'asal_sekolah' => $validated['asal_sekolah'],
        'nama_ortu' => $validated['nama_ortu'],
        'hp_ortu' => $validated['hp_ortu'],
        'dokumen_path' => $path,
    ]);

return \Inertia\Inertia::location(url()->previous());
}

}
