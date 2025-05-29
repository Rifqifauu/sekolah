<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_settings', function (Blueprint $table) {
          $table->id();

    // Logo
    $table->string('logo')->nullable();

    // Hero Section
    $table->string('judul_hero')->nullable();
    $table->text('deskripsi_hero')->nullable();
    $table->string('gambar_hero')->nullable();

    // Sejarah
    $table->string('judul_sejarah')->nullable();
    $table->longText('deskripsi_sejarah')->nullable();
    $table->string('gambar_sejarah')->nullable();

    // Video Section
    $table->string('judul_video')->nullable();
    $table->text('deskripsi_video')->nullable();
    $table->string('url_video')->nullable();
    $table->text('visi')->nullable();
    $table->text('misi')->nullable();

    // Struktur Organisasi
    $table->string('gambar_struktur_organisasi')->nullable();

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_settings');
    }
};
