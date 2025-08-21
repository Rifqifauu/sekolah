<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul_buku');
            $table->string('pengarang');
            $table->string('penerbit')->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->string('isbn')->nullable();
            $table->string('cover')->nullable(); // path file cover
            $table->string('kategori')->nullable();
            $table->integer('jumlah')->default(0); // ubah jadi integer
            $table->enum('status', ['tersedia', 'kosong'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_buku');
    }
};
