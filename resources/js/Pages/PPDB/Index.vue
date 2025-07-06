<template>
  <AppLayout>
    <section class="max-w-5xl mx-auto py-12 px-6">
      <!-- Hero Section -->
      <div 
        class="relative h-36 bg-cover bg-center rounded-xl shadow-lg mb-12 overflow-hidden" 
        data-aos="fade-down"
        data-aos-duration="1000"
      >
        <div class="absolute inset-0 bg-red-800 flex items-center justify-center">
          <div class="text-center text-white px-4">
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Penerimaan Peserta Didik Baru</h1>
            <p class="text-md md:text-lg">Tahun Ajaran 2025/2026</p>
          </div>
        </div>
      </div>

      <!-- Tanggal Pendaftaran -->
      <div class="mb-10" data-aos="fade-up" data-aos-duration="800">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <!-- Kartu 1 -->
          <div class="bg-white border border-red-600 rounded-xl shadow-lg px-4 py-4 flex items-center gap-3"
               data-aos="zoom-in" data-aos-duration="800">
            <svg class="hidden md:block w-8 h-8 text-red-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M8 7V3M16 7V3M3 11h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <div class="text-xs md:text-sm">
              <p class="text-gray-500">Pendaftaran Dibuka</p>
              <p class="font-bold text-red-700">1 – 15 Juli 2025</p>
            </div>
          </div>

          <!-- Kartu 2 -->
          <div class="bg-white border border-red-600 rounded-xl shadow-lg px-4 py-4 flex items-center gap-3"
               data-aos="zoom-in" data-aos-duration="800" data-aos-delay="100">
            <svg class="hidden md:block w-8 h-8 text-red-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M8 7V3M16 7V3M3 11h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <div class="text-xs md:text-sm">
              <p class="text-gray-500">Pengumuman Hasil</p>
              <p class="font-bold text-red-700">21 Juli 2025</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Syarat Pendaftaran -->
      <div class="bg-red-50 border-l-4 border-red-700 rounded-lg shadow p-6 mb-10"
           data-aos="fade-right" data-aos-duration="1000">
        <h2 class="text-2xl font-semibold text-red-800 mb-4">📌 Syarat Pendaftaran</h2>
        <ul class="space-y-3">
          <li class="flex items-center gap-3" v-for="(item, index) in syarat" :key="index">
            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
              <path d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" />
            </svg>
            {{ item }}
          </li>
        </ul>
      </div>

      <!-- Tombol Daftar -->
      <div class="text-center" data-aos="zoom-in-up" data-aos-duration="800">
        <button
          @click="$inertia.visit('/ppdb/formulir')"
          class="bg-red-700 hover:scale-105 hover:bg-red-600 text-white text-lg font-semibold px-8 py-3 rounded-full shadow transition-transform duration-300 flex items-center gap-2 mx-auto"
        >
          📄 <span>Daftar Sekarang</span>
        </button>
      </div>
    </section>
  </AppLayout>
</template>

<script>
import AppLayout from '../../layouts/AppLayout.vue'
import AOS from 'aos'
import 'aos/dist/aos.css'

export default {
  layout: AppLayout,
  data() {
    return {
      syarat: [
        'Fotokopi Akta Kelahiran',
        'Fotokopi Kartu Keluarga',
        'Pas Foto 3x4 sebanyak 3 lembar',
        'Fotokopi Rapor kelas terakhir',
        'Surat Keterangan Lulus dari sekolah asal'
      ]
    }
  },
  mounted() {
    AOS.init({
      once: true, // animasi hanya sekali saat scroll ke view
    });
  },
}
</script>
