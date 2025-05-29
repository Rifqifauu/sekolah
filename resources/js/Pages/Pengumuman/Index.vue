<template>
  <div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
      <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="w-full md:w-2/3">
          <div class="flex items-center mb-6">
            <div class="w-1 h-8 bg-red-600 mr-3"></div>
            <h1 class="text-2xl font-bold text-gray-800">Pengumuman Terbaru</h1>
          </div>

          <div v-if="paginated.length === 0" class="bg-white rounded-xl shadow-sm p-12 text-center">
            <svg class="w-16 h-16 text-red-200 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <p class="text-gray-600">Tidak ada pengumuman yang tersedia saat ini.</p>
          </div>

          <div v-else class="space-y-5">
            <div
              v-for="pengumuman in paginated"
              :key="pengumuman.id"
              class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden border-l-4 border-red-500"
              data-aos="fade-up"
            >
              <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2 hover:text-red-600 transition">{{ pengumuman.judul }}</h2>
                <div class="flex items-center text-gray-500 text-sm mb-3">
                  <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                  </svg>
                  <span>{{ formatTanggal(pengumuman.created_at) }}</span>
                </div>

                <div class="prose prose-sm max-w-none text-gray-600 line-clamp-3 mb-4">
                  <p v-html="pengumuman.isi"></p>
                </div>

                <Link :href="`/pengumuman/${pengumuman.id}`" class="inline-flex items-center text-red-600 font-medium hover:text-red-800 transition">
                  <span>Baca selengkapnya</span>
                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                  </svg>
                </Link>
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
  popularArticles: Array,
  pengumuman: Array,
})

const currentPage = ref(1)
const perPage = 5

const totalPages = computed(() =>
  Math.ceil(props.pengumuman.length / perPage)
)

const paginated = computed(() => {
  const start = (currentPage.value - 1) * perPage
  return props.pengumuman.slice(start, start + perPage)
})

function formatTanggal(date) {
  const options = { year: 'numeric', month: 'long', day: 'numeric' }
  return new Date(date).toLocaleDateString('id-ID', options)
}
onMounted(() => {
  AOS.init({
    duration: 800,
    once: true,
    offset: 50,      // kecilkan offset supaya animasi gak bikin scroll geser aneh
    disable: function() {
      // Disable AOS hanya di layar kecil kalau mau (optional)
      return window.innerWidth < 768; 
    }
  });
      document.title = 'Pengumuman';          

});
</script>