<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSetting extends Model
{
    // Nama tabel (opsional, Laravel otomatis pakai 'page_settings')
    protected $table = 'page_settings';

    // Field yang boleh diisi massal (mass assignable)
    protected $fillable = [
        'logo',
        'judul_hero',
        'deskripsi_hero',
        'gambar_hero',
        'gambar_hero1',
        'gambar_hero2',
        'judul_sejarah',
        'deskripsi_sejarah',
        'gambar_sejarah',
        'gambar_sejarah1',
        'gambar_sejarah2',
        'visi',
        'misi',
        'judul_video',
        'deskripsi_video',
        'url_video',
        'gambar_struktur_organisasi',
    ];
}
