<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBuku extends Model
{
    protected $table = 'data_buku';

    protected $fillable = [
        'judul_buku',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'cover', // path file cover
        'kategori',
        'jumlah', // ubah jadi integer
        'status'
    ];

}
