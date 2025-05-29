<template>
  <div class="flex flex-col min-h-screen bg-gray-50">

    <div class="flex-1 p-4 md:p-6 space-y-6">
      <!-- Header Section with Search -->
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <h1 class="text-2xl md:text-3xl font-extrabold text-red-700 pb-2 max-w-max">
          Galeri Foto <span class="text-black">{{ galeri.nama_galeri }}</span>
        </h1>

        <div class="w-full md:w-auto flex">
          <div class="relative w-full">
            <input 
              type="text" 
              v-model="search" 
              placeholder="Cari foto..." 
              class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 w-full"
            />
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
        </div>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="flex justify-center items-center py-12">
        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-red-500"></div>
      </div>

      <!-- Empty State -->
      <div v-else-if="filteredImages.length === 0" class="flex flex-col items-center justify-center py-12 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h3 class="text-lg font-medium text-gray-700">Tidak ada foto yang ditemukan</h3>
        <p class="text-gray-500 mt-2">Coba dengan kata kunci pencarian yang berbeda</p>
      </div>

      <!-- Image Gallery Grid -->
      <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4 md:gap-6">
        <div
          v-for="(item, index) in paginatedImages"
          :key="item.id"
          class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden transition duration-300 hover:shadow-lg hover:border-red-200"
          :data-aos="isAosEnabled ? 'fade-up' : ''"
          :data-aos-delay="isAosEnabled ? index * 50 : 0"
        >
          <div class="p-4">
            <img
              :src="`/storage/${item.path}`"
              :alt="item.caption"
              class="w-full h-64 object-cover rounded-lg"
            />
            <h2 class="mt-3 text-md text-gray-800 truncate" :title="item.caption">
              {{ item.caption || '' }}
            </h2>
            <p class="text-xs text-gray-500 mt-1">
              {{ formatDate(item.created_at) }}
            </p>
          </div>
        </div>
      </div>

      <!-- Pagination Controls -->
      <div v-if="totalPages > 1" class="flex justify-center mt-6 space-x-2">
        <button
          @click="goToPage(currentPage - 1)"
          :disabled="currentPage === 1"
          class="px-3 py-1 rounded border text-sm font-medium"
          :class="currentPage === 1 ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-white text-red-600 border-red-300 hover:bg-red-50'"
        >
          Prev
        </button>

        <button
          v-for="page in totalPages"
          :key="page"
          @click="goToPage(page)"
          class="px-3 py-1 rounded border text-sm font-medium"
          :class="currentPage === page ? 'bg-red-600 text-white border-red-600' : 'bg-white text-red-600 border-red-300 hover:bg-red-50'"
        >
          {{ page }}
        </button>

        <button
          @click="goToPage(currentPage + 1)"
          :disabled="currentPage === totalPages"
          class="px-3 py-1 rounded border text-sm font-medium"
          :class="currentPage === totalPages ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-white text-red-600 border-red-300 hover:bg-red-50'"
        >
          Next
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import AOS from 'aos'
import 'aos/dist/aos.css'
import { onMounted, ref, computed, onBeforeUnmount, watch } from 'vue'
import AppLayout from '../../layouts/AppLayout.vue'
const props = defineProps({
  images: {
    type: Array,
    default: () => []
  },
  galeri: {
    type: Array,
    default: () => []
  }
  
})


const isAosEnabled = ref(window.innerWidth >= 768)
const loading = ref(false)
const search = ref('')

const itemsPerPage = 8
const currentPage = ref(1)

const checkScreenSize = () => {
  isAosEnabled.value = window.innerWidth >= 768
}

const filteredImages = computed(() => {
  return props.images.filter(item => {
    return (
      search.value === '' ||
      (item.caption && item.caption.toLowerCase().includes(search.value.toLowerCase()))
    )
  })
})

const totalPages = computed(() => {
  return Math.ceil(filteredImages.value.length / itemsPerPage)
})

const paginatedImages = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filteredImages.value.slice(start, end)
})

const goToPage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page
    window.scrollTo({ top: 0, behavior: 'smooth' })
  }
}

// Reset to page 1 when search changes
watch(search, () => {
  currentPage.value = 1
})

const formatDate = (dateString) => {
  if (!dateString) return '-'
  const options = { day: 'numeric', month: 'long', year: 'numeric' }
  return new Date(dateString).toLocaleDateString('id-ID', options)
}

defineOptions({
    layout: AppLayout
})

onMounted(() => {
  AOS.init({
    duration: 800,
    once: true,
    offset: 50
  })

  window.addEventListener('resize', checkScreenSize)

  loading.value = true
  setTimeout(() => {
    loading.value = false
  }, 500)
})

onBeforeUnmount(() => {
  window.removeEventListener('resize', checkScreenSize)
})

</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
