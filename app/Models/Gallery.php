<?php

namespace App\Models;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
     protected $fillable = [
        'nama_galeri',
        'deskripsi',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
