<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikuler'; // optional, karena sudah sesuai nama tabel

    protected $fillable = [
        'nama',
        'deskripsi',
        'nama_pembina',
        'nama_ketua',
        'jadwal',
        'lokasi',
        'gambar',
    ];
}
