<template>
  <div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
      <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="w-full lg:w-2/3">
          <div class="flex items-start mb-6 flex-col">
            <div class="flex items-center mb-1">
              <div class="w-1 h-8 bg-red-600 mr-3"></div>
              <h1 class="text-2xl font-bold text-gray-800">Hasil Pencarian</h1>
            </div>
            <div class="text-sm text-gray-500">
              <template v-if="keyword">
                Menampilkan hasil untuk: <strong>"{{ keyword }}"</strong>
              </template>
              <template v-if="artikels.length">
                <br />Ditemukan {{ artikels.length }} artikel
              </template>
            </div>
          </div>

          <div v-if="paginated.length === 0" class="bg-white rounded-xl shadow-sm p-12 text-center">
            <svg class="w-16 h-16 text-red-200 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <p class="text-gray-600">Tidak ditemukan artikel dengan kata kunci "<strong>{{ query }}</strong>".</p>
          </div>

          <div v-else class="space-y-5">
            <div
              v-for="artikel in paginated"
              :key="artikel.id"
              class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden border-l-4 border-red-500"
              data-aos="fade-up"
            >
              <div class="flex flex-col md:flex-row p-4 md:p-5 gap-2 md:gap-3">
                <!-- Gambar artikel -->
                <img
                  :src="`/storage/${artikel.gambar}`"
                  alt="Thumbnail artikel"
                  class="w-full md:w-32 h-28 object-cover rounded-md"
                />

                <!-- Konten artikel -->
                <div class="flex-1 text-sm">
                  <h2 class="text-base md:text-lg font-semibold text-gray-800 mb-1 hover:text-red-600 transition leading-snug">
                    {{ artikel.judul }}
                  </h2>
                  <div class="flex items-center text-gray-500 text-xs mb-2">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path
                        fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                    <span>{{ formatTanggal(artikel.published_at) }}</span>
                  </div>

                  <div class="text-gray-600 line-clamp-2 mb-3 text-xs leading-snug">
                    <p v-html="artikel.isi"></p>
                  </div>

                  <Link
                    :href="`/artikel/${artikel.slug}`"
                    class="inline-flex items-center text-red-600 text-sm font-medium hover:text-red-800 transition"
                  >
                    <span>Baca selengkapnya</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                  </Link>
                </div>
              </div>
            </div>
          </div>

          <!-- Pagination -->
          <div class="mt-10 flex justify-center">
            <nav class="flex items-center space-x-1">
              <button
                @click="currentPage > 1 && (currentPage--)"
                :disabled="currentPage === 1"
                class="px-3 py-2 rounded-md text-sm font-medium"
                :class="currentPage === 1 ? 'text-gray-400 cursor-not-allowed' : 'text-gray-700 hover:bg-red-50'"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
              </button>

              <div class="flex space-x-1">
                <button
                  v-for="page in totalPages"
                  :key="page"
                  @click="currentPage = page"
                  class="px-4 py-2 text-sm font-medium rounded-md transition-colors"
                  :class="{
                    'bg-red-600 text-white': currentPage === page,
                    'text-gray-700 hover:bg-red-50': currentPage !== page
                  }"
                >
                  {{ page }}
                </button>
              </div>

              <button
                @click="currentPage < totalPages && currentPage++"
                :disabled="currentPage === totalPages"
                class="px-3 py-2 rounded-md text-sm font-medium"
                :class="currentPage === totalPages ? 'text-gray-400 cursor-not-allowed' : 'text-gray-700 hover:bg-red-50'"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </button>
            </nav>
          </div>
        </div>

        <!-- Sidebar -->
        <Side :popularArticles="popularArticles" :pengumuman="pengumuman" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import AOS from 'aos'
import 'aos/dist/aos.css'

import Side from '../../components/Side.vue'
import AppLayout from '@/layouts/AppLayout.vue'

defineOptions({
  layout: AppLayout,
})

const props = defineProps({
  artikels: Array,
  popularArticles: Array,
  pengumuman: Array,
  query: String, // kata kunci pencarian
})

const currentPage = ref(1)
const perPage = 5

const totalPages = computed(() =>
  Math.ceil(props.artikels.length / perPage)
)

const paginated = computed(() => {
  const start = (currentPage.value - 1) * perPage
  return props.artikels.slice(start, start + perPage)
})

function formatTanggal(date) {
  const options = { year: 'numeric', month: 'long', day: 'numeric' }
  return new Date(date).toLocaleDateString('id-ID', options)
}

onMounted(() => {
  AOS.init({
    duration: 800,
    once: true,
    offset: 100,
  });
        document.title = 'Cari Artikel';          


  window.addEventListener('load', () => {
    AOS.refresh();
  });

  setTimeout(() => {
    AOS.refresh();
  }, 500);
});
</script>
