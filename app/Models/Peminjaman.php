<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
        protected $guarded = [];

        public function buku()
        {
            return $this->belongsTo(DataBuku::class, 'id_buku', 'id');
        }
        public function anggota()
        {
            return $this->belongsTo(People::class, 'id_anggota', 'id');
        }
    //
}
