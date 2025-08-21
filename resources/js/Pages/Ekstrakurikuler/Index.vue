<template>
  <div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
      <div class="flex flex-col lg:flex-row gap-8">
      <!-- Konten utama -->
      <div class="w-full lg:w-2/3 md:col-span-8 space-y-10">
        <div class="flex items-center space-x-4 mb-2">
          <div class="w-1 h-8 bg-green-500 rounded-full"></div>
          <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Ekstrakurikuler</h1>
        </div>

        <div class="grid grid-cols-1 gap-8">
          <div
            v-for="item in ekstrakurikuler"
            :key="item.id"
              data-aos="fade-up"
  data-aos-duration="1000"
            class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group"
          >
            <div class="flex flex-col md:flex-row">
              <!-- Gambar dengan overlay hover effect -->
              <div class="md:w-2/5 h-72 relative overflow-hidden">
                <img
                  :src="`/storage/${item.gambar}`"
                  :alt="item.nama"
                  class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-green-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                  <span class="text-white font-bold text-xl p-4">{{ item.nama }}</span>
                </div>
              </div>

              <!-- Informasi -->
              <div class="md:w-3/5 p-6 flex flex-col justify-between bg-white">
                <div>
                  <h2 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-green-600 transition-colors duration-300">{{ item.nama }}</h2>
                  <p class="text-gray-600 mb-6 line-clamp-3">{{ item.deskripsi }}</p>

                  <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="flex items-center space-x-2">
                      <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <div>
                        <p class="text-xs text-gray-500">Pembina</p>
                        <p class="font-medium text-gray-800">{{ item.nama_pembina }}</p>
                      </div>
                    </div>

                    <div class="flex items-center space-x-2">
                      <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                      </div>
                      <div>
                        <p class="text-xs text-gray-500">Ketua</p>
                        <p class="font-medium text-gray-800">{{ item.nama_ketua }}</p>
                      </div>
                    </div>

                    <div class="flex items-center space-x-2">
                      <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <div>
                        <p class="text-xs text-gray-500">Jadwal</p>
                        <p class="font-medium text-gray-800">{{ item.jadwal }}</p>
                      </div>
                    </div>

                    <div class="flex items-center space-x-2">
                      <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <div>
                        <p class="text-xs text-gray-500">Lokasi</p>
                        <p class="font-medium text-gray-800">{{ item.lokasi }}</p>
                      </div>
                    </div>
                  </div>
                </div>
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
import AppLayout from '@/layouts/AppLayout.vue'
import Side from '@/components/Side.vue'
import AOS from 'aos'
import 'aos/dist/aos.css'

import { onMounted } from 'vue'

defineProps({
  ekstrakurikuler: {
    type: Object,
    required: true
  },
  popularArticles: {
    type: Array,
    required: true
  },
  pengumuman: {
    type: Array,
    required: true
  }
})


defineOptions({
  layout: AppLayout
})

onMounted(() => {
      document.title = 'Ekstrakurikuler';

  AOS.init({
    duration: 800,
    once: true,
    offset: 100,
  })
})
</script>
