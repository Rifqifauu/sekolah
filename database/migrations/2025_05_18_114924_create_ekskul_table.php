<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ekstrakurikuler', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('nama_pembina')->nullable();
            $table->string('nama_ketua')->nullable();
            $table->string('jadwal')->nullable();
            $table->string('lokasi')->nullable();
            $table->string(column: 'gambar')->nullable(); // misalnya simpan path gambar di storage
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ekstrakurikuler');
    }
};