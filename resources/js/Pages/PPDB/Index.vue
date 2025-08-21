<template>
  <AppLayout>
    <section class="max-w-5xl mx-auto py-12 px-6">
      <!-- Hero Section -->
      <div
        class="relative h-36 bg-cover bg-center rounded-xl shadow-lg mb-12 overflow-hidden"
        data-aos="fade-down"
        data-aos-duration="1000"
      >
        <div class="absolute inset-0 bg-green-800 flex items-center justify-center">
          <div class="text-center text-white px-4">
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Penerimaan Murid Baru</h1>
            <p class="text-md md:text-lg">Tahun Ajaran 2025/2026</p>
          </div>
        </div>
      </div>

      <!-- Tanggal Pendaftaran -->
      <div class="mb-10" data-aos="fade-up" data-aos-duration="800">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <!-- Kartu 1 -->
          <div class="bg-white border border-green-600 rounded-xl shadow-lg px-4 py-4 flex items-center gap-3"
               data-aos="zoom-in" data-aos-duration="800">
            <svg class="hidden md:block w-8 h-8 text-green-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M8 7V3M16 7V3M3 11h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <div class="text-xs md:text-sm">
              <p class="text-gray-500">Pendaftaran Dibuka</p>
              <p class="font-bold text-green-700">{{ pageSettings?.tanggal_ppdb || 'Belum ditentukan' }}</p>
            </div>
          </div>

          <!-- Kartu 2 -->
          <div class="bg-white border border-green-600 rounded-xl shadow-lg px-4 py-4 flex items-center gap-3"
               data-aos="zoom-in" data-aos-duration="800" data-aos-delay="100">
            <svg class="hidden md:block w-8 h-8 text-green-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M8 7V3M16 7V3M3 11h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <div class="text-xs md:text-sm">
              <p class="text-gray-500">Pengumuman Hasil</p>
              <p class="font-bold text-green-700">{{ pageSettings?.pengumuman_ppdb || 'Belum ditentukan' }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Syarat Pendaftaran -->
      <div class="bg-green-50 border-l-4 border-green-700 rounded-lg shadow p-6 mb-10"
           data-aos="fade-right" data-aos-duration="1000">
        <h2 class="text-2xl font-semibold text-green-800 mb-4">📌 Syarat Pendaftaran</h2>
<p v-html="pageSettings?.syarat_ppdb || 'Syarat pendaftaran akan diinformasikan kemudian.'" class="leading-relaxed text-gray-700 text-sm"></p>
      </div>

      <!-- Tombol Daftar -->
      <div class="text-center" data-aos="zoom-in-up" data-aos-duration="800">
        <button
          @click="$inertia.visit('/spmb/formulir')"
          class="bg-green-700 hover:scale-105 hover:bg-green-600 text-white text-lg font-semibold px-8 py-3 rounded-full shadow transition-transform duration-300 flex items-center gap-2 mx-auto"
        >
           <span>Daftar Sekarang</span>
        </button>

      </div>
    </section>
  </AppLayout>
</template>

<script>
import AppLayout from '../../layouts/AppLayout.vue'
import AOS from 'aos'
import 'aos/dist/aos.css'
import { usePage } from '@inertiajs/vue3'
import { computed, onMounted } from 'vue'

export default {
  components: {
    AppLayout
  },

  props: {
    page_setting: {
      type: Object,
      default: () => ({})
    }
  },

  setup(props) {
    const page = usePage()

    // Mengakses props dengan benar
    const pageSettings = computed(() => {
      // Coba ambil dari props terlebih dahulu
      if (props.page_setting && Object.keys(props.page_setting).length > 0) {
        return props.page_setting
      }

      // Jika tidak ada, coba dari page props
      return page?.props?.page_setting || {}
    })

    onMounted(() => {
            document.title = 'SPMB - SMK Maarif NU 1 Ketanggungan'

      AOS.init({ once: true })

    })

    return {
      pageSettings
    }
  }
}
</script>
