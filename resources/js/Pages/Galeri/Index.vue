<template>
  <div class="bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen py-14">
    <div class="container mx-auto px-6">
      <!-- Header section dengan styling yang lebih menarik -->
      <div class="flex flex-col lg:flex-row gap-10">
        <div class="w-full lg:w-2/3 space-y-8">
          <div class="relative mb-10">
            <div class="absolute -left-2 top-0 w-20 h-20 bg-green-500 opacity-10 rounded-full"></div>
            <div class="absolute -left-1 top-1 w-12 h-12 bg-green-400 opacity-20 rounded-full"></div>
            <div class="flex items-center mb-2">
              <div class="w-1.5 h-10 bg-gradient-to-b from-green-400 to-green-600 rounded-full mr-4"></div>
              <h1 class="text-4xl font-bold text-gray-800 relative z-10">
                Galeri
                <span class="block h-3 w-24 bg-green-400 opacity-30 -mt-2 rounded"></span>
              </h1>
            </div>
            <p class="text-gray-600 pl-6">Koleksi momen terbaik kami dalam gambar</p>
          </div>

          <!-- Grid galeri dengan desain yang lebih menarik dan responsive -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div
              v-for="item in galeri"
              :key="item.id"
              data-aos="fade-up"
              data-aos-duration="800"
              class="bg-white rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden group relative flex flex-col"
            >

              <!-- Gambar dengan efek gradien dan ukuran yang konsisten -->
              <div class="h-48 sm:h-60 md:h-64 w-full overflow-hidden relative">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                <img
                  :src="item.images?.[0]?.path ? `/storage/${item.images[0].path}` : '/placeholder.jpg'"
                  :alt="item.nama"
                  class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                  loading="lazy"
                />
              </div>

              <!-- Konten dengan desain yang lebih menarik dan responsive -->
              <div class="p-4 sm:p-6 flex flex-col border-t border-gray-100">
                <div class="mb-3">
                  <div class="flex items-center mb-2">
                    <span class="w-1 h-4 bg-green-500 rounded mr-2 flex-shrink-0"></span>
                    <h2 class="text-lg sm:text-xl font-bold text-gray-800 group-hover:text-green-600 transition-colors duration-300 line-clamp-1">
                      {{ item.nama_galeri }}
                    </h2>
                  </div>
                  <p class="text-gray-600 text-xs sm:text-sm line-clamp-2 mb-2">
                    {{ item.deskripsi }}
                  </p>
                  <div class="flex items-center text-xs text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ formatTanggal(item.created_at) }}
                  </div>
                </div>

                <!-- Tombol dengan desain yang lebih menarik -->
                <div class="mt-auto pt-2">
                  <Link
                    :href="`/galeri/${item.id}`"
                    class="inline-flex items-center text-xs sm:text-sm font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 px-3 sm:px-5 py-1.5 sm:py-2 rounded-lg transition-all duration-300 shadow-sm hover:shadow"
                  >
                    <span>Lihat Galeri</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 ml-1 sm:ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>

              <Side :popularArticles="popularArticles" :pengumuman="pengumuman" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import Side from '@/components/Side.vue'
import AOS from 'aos'
import 'aos/dist/aos.css'
import { onMounted } from 'vue'

defineProps({
  galeri: Array,
  popularArticles: Array,
  pengumuman: Array
})

defineOptions({
  layout: AppLayout
})

onMounted(() => {
  document.title = 'Galeri'
  AOS.init({
    duration: 800,
    once: true,
    offset: 100,
  })
})

function formatTanggal(tanggal) {
  const date = new Date(tanggal)
  return date.toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric',
  })
}
</script>
