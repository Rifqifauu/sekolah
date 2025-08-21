<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    // Nama tabel jika tidak default "artikels"
    protected $table = 'artikel';

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'judul',
        'slug',
        'gambar',
        'isi',
        'excerpt',
        'id_user',
        'kategori',
        'status',
        'published_at',
        'view_count',
    ];

    // Jika kamu pakai tipe tanggal untuk published_at
    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
    ];

    // Relasi ke User (penulis artikel)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Accessor contoh: judul dengan slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
