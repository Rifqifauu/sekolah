<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

 protected $fillable = [
    'pilihan_program',
    'nama',
    'tempat_tanggal_lahir',
    'jenis_kelamin',
    'agama',
    'kip',
    'nomor_kip',
    'nisn',
    'asal_sekolah',
    'alamat',
    'alamat_ortu',
    'provinsi',
    'kabupaten',
    'kecamatan',
    'desa',
    'rt',
    'rw',
    'kode_pos',
    'jml_saudara',
    'anak_ke',
    'tinggi_badan',
    'berat_badan',
    'hp',
    'telp_rumah',
    'nama_ayah',
    'tahun_ayah',
    'pekerjaan_ayah',
    'penghasilan_ayah',
    'nama_ibu',
    'tahun_ibu',
    'pekerjaan_ibu',
    'penghasilan_ibu',
    'nama_wali',
    'tahun_wali',
    'pekerjaan_wali',
    'penghasilan_wali',
    'dokumen_path',
    'foto_path',
];

}
