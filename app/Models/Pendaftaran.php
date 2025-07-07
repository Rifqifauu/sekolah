<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected  $table = 'pendaftaran';
     protected $fillable = [
        'nama',
        'email',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'asal_sekolah',
        'nisn',
        'nama_ortu',
        'hp_ortu',
        'dokumen_path',
    ];
}
