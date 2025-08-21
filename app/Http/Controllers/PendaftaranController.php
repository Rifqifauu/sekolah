<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;


class PendaftaranController extends Controller
{
    public function index()
    {
        return Inertia::render('PPDB/Index');
    }

    public function create()
    {
        return Inertia::render('PPDB/Daftar');
    }

 public function store(Request $request)
{
    // Validasi umum
    $validated = $request->validate([
        'pilihan_program' => 'required|string|max:255',
        'nama' => 'required|string|max:255',
        'tempat_tanggal_lahir' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
        'agama' => 'required|string|max:50',
'kip' => 'required|in:true,false,1,0',
         'nomor_kip' => 'nullable|string|max:50',
        'nisn' => 'required|string|max:20|unique:pendaftaran,nisn',
        'asal_sekolah' => 'required|string|max:255',
        'alamat' => 'required|string',
        'alamat_ortu' => 'required|string',
        'provinsi' => 'required|string|max:100',
        'kabupaten' => 'required|string|max:100',
        'kecamatan' => 'required|string|max:100',
        'desa' => 'required|string|max:100',
        'rt' => 'required|string|max:10',
        'rw' => 'required|string|max:10',
        'kode_pos' => 'required|string|max:10',
        'jml_saudara' => 'required|integer|min:0',
        'anak_ke' => 'required|integer|min:1',
        'tinggi_badan' => 'required|numeric|min:0|max:300',
        'berat_badan' => 'required|numeric|min:0|max:300',
        'hp' => 'required|string|max:20',
        'telp_rumah' => 'nullable|string|max:20',

        // Orang tua boleh kosong
        'nama_ayah' => 'nullable|string|max:255',
        'tahun_ayah' => 'nullable|string|max:10',
        'pekerjaan_ayah' => 'nullable|string|max:255',
        'penghasilan_ayah' => 'nullable|string|max:100',
        'nama_ibu' => 'nullable|string|max:255',
        'tahun_ibu' => 'nullable|string|max:10',
        'pekerjaan_ibu' => 'nullable|string|max:255',
        'penghasilan_ibu' => 'nullable|string|max:100',

        // Wali default required
        'nama_wali' => 'nullable|string|max:255',
        'tahun_wali' => 'nullable|string|max:10',
        'pekerjaan_wali' => 'nullable|string|max:255',
        'penghasilan_wali' => 'nullable|string|max:100',

        'dokumen' => 'required|file|mimes:pdf|max:2048',
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:1024',
    ]);

    // Cek jika ayah & ibu kosong, maka wali wajib
    $ayahKosong = empty($validated['nama_ayah']) && empty($validated['tahun_ayah']);
    $ibuKosong = empty($validated['nama_ibu']) && empty($validated['tahun_ibu']);

    if ($ayahKosong && $ibuKosong) {
        $request->validate([
            'nama_wali' => 'required|string|max:255',
            'tahun_wali' => 'required|string|max:10',
            'pekerjaan_wali' => 'required|string|max:255',
            'penghasilan_wali' => 'required|string|max:100',
        ]);
    }

    // Upload file
    $dokumenPath = $request->file('dokumen')->store('dokumen_ppdb');
    $fotoPath = $request->file('foto')->store('foto_ppdb');

 $validated['kip'] = filter_var($validated['kip'], FILTER_VALIDATE_BOOLEAN);
$validated['dokumen_path'] = $dokumenPath;
$validated['foto_path'] = $fotoPath;

// Simpan data
Pendaftaran::create($validated);

    return back()->with('success', 'Pendaftaran berhasil!');
}

   public function generatePDF($id)
{
    $pendaftar = Pendaftaran::findOrFail($id);

$pdf = Pdf::loadView('pdf.formulir', compact('pendaftar'))
          ->setPaper('legal', 'portrait');

return $pdf->stream('formulir-ppdb.pdf'); // Ganti download() dengan stream()
}
}
