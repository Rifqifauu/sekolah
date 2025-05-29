<template>
  <div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
      <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div
          class="w-full md:w-2/3 bg-white contact-page max-w-full mx-auto rounded-xl sm:rounded-3xl py-5 px-6 shadow-xl"
        >
 <h1 class="text-2xl md:text-4xl font-bold text-red-800 mb-2">Struktur Organisasi</h1>
            <div class="w-16 h-1 bg-red-700 rounded mb-4"></div>          <img
            :src="'/storage/' + page_setting.gambar_struktur_organisasi"
            alt="Struktur Organisasi"
            class="w-full h-auto rounded"
          />
        </div>

        <!-- Sidebar -->
        <Side :popularArticles="popularArticles" :pengumuman="pengumuman" />
      </div>
    </div>
  </div>
</template>

<script setup>
import AppLayout from '../layouts/AppLayout.vue';
import { onMounted } from 'vue';
import Side from '../components/Side.vue';

defineOptions({
  layout: AppLayout,
});

defineProps({
  popularArticles: Array,
  pengumuman: Array,
  page_setting: Object,
});

onMounted(() => {
  document.title = 'Struktur Organisasi';
});
</script>
