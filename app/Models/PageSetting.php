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
        'judul_sejarah',
        'deskripsi_sejarah',
        'gambar_sejarah',
        'visi',
        'misi',
        'judul_video',
        'deskripsi_video',
        'url_video',
        'gambar_struktur_organisasi',
    ];
}
