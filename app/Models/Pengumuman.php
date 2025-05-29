<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman'; // Nama tabel yang digunakan

    protected $fillable = [
        'judul',
        'isi',
        'file',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}
