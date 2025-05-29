<template>
  <!-- Sidebar Popular Articles & Pengumuman -->
  <aside
    class="w-full md:w-1/3 bg-white rounded-lg p-6 shadow-lg md:border-l-4 md:border-red-600 overflow-hidden"
    data-aos="fade-up"
    data-aos-delay="200"
    data-aos-anchor-placement="top-bottom"
  >
    <!-- Artikel Populer Section -->
    <div class="mb-10">
      <h2
        class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-red-500 pb-3 inline-block relative"
      >
        <span class="text-red-600">Artikel</span> Populer
        <div class="absolute -bottom-0.5 left-0 w-12 h-1 bg-red-600 rounded-full"></div>
      </h2>
      
      <ul class="space-y-4">
        <li
          v-for="(item, index) in popularArticles"
          :key="item.id"
          class="bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-red-200"
        >
          <div class="flex items-start gap-3">
            <div
              class="flex-shrink-0 w-8 h-8 mt-1 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg flex items-center justify-center font-semibold text-md select-none shadow-sm"
            >
              {{ index + 1 }}
            </div>
            <div class="flex-1 min-w-0">
              <a
                :href="`/artikel/${item.slug}`"
                class="text-gray-800 font-semibold hover:text-red-600 transition-colors duration-200 line-clamp-2 block mb-1"
                :title="`Baca artikel: ${item.judul}`"
              >
                {{ item.judul }}
              </a>
              <div class="flex items-center text-xs text-gray-500 mb-2">
                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="truncate">{{ formatDate(item.created_at) }}</span>
              </div>
              <p class="text-gray-600 line-clamp-2 text-sm">
                {{ item.cuplikan }}
              </p>
            </div>
          </div>
        </li>
      </ul>

      <div class="mt-4 text-center">
        <a href="/artikel" class="inline-block px-4 py-2 bg-white text-red-600 border border-red-500 rounded-md hover:bg-red-600 hover:text-white transition-colors duration-300 text-sm font-medium">
          Lihat Semua Artikel
        </a>
      </div>
    </div>

    <!-- Pengumuman Section -->
    <div>
      <h2
        class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-red-500 pb-3 inline-block relative"
      >
        <span class="text-red-600">Pengumuman</span> Terbaru
        <div class="absolute -bottom-0.5 left-0 w-12 h-1 bg-red-600 rounded-full"></div>
      </h2>
      
      <ul class="space-y-4">
        <li
          v-for="(item, index) in pengumuman"
          :key="item.id"
          class="bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-red-200"
        >
          <div class="flex items-start gap-3">
            <div
              class="flex-shrink-0 w-10 h-10 mt-1 bg-gradient-to-br from-red-500 to-red-700 text-white rounded-full flex flex-col items-center justify-center font-semibold text-xs leading-tight select-none shadow-sm"
            >
              <span>{{ new Date(item.created_at).getDate() }}</span>
              <span>{{ getShortMonth(item.created_at) }}</span>
            </div>
            <div class="flex-1 min-w-0">
              <a
                :href="`/pengumuman/${item.id}`"
                class="text-gray-800 font-semibold hover:text-red-600 transition-colors duration-200 line-clamp-2 block mb-1"
                :title="`Baca pengumuman: ${item.judul}`"
              >
                {{ item.judul }}
              </a>
              <div class="flex items-center text-xs text-gray-500 mb-2">
                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="truncate">{{ isBaru(item.created_at) ? 'Baru!' : formatDate(item.created_at) }}</span>
              </div>
              <p class="text-gray-600 line-clamp-2 text-sm">
                {{ item.cuplikan }}
              </p>
            </div>
          </div>
        </li>
      </ul>

      <div class="mt-4 text-center">
        <a href="/pengumuman" class="inline-block px-4 py-2 bg-white text-red-600 border border-red-500 rounded-md hover:bg-red-600 hover:text-white transition-colors duration-300 text-sm font-medium">
          Lihat Semua Pengumuman
        </a>
      </div>
    </div>
  </aside>
</template>

<script>
export default {
  name: "Side",
  props: {
    popularArticles: {
      type: Array,
      required: true,
    },
    pengumuman: {
      type: Array,
      required: true,
    },
  },
  methods: {
    formatDate(dateStr) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      return new Date(dateStr).toLocaleDateString("id-ID", options);
    },
    getShortMonth(dateStr) {
      const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
      const date = new Date(dateStr);
      return months[date.getMonth()];
    },
    isBaru(dateStr) {
      // Menentukan apakah pengumuman dibuat dalam 3 hari terakhir
      const threeDaysAgo = new Date();
      threeDaysAgo.setDate(threeDaysAgo.getDate() - 3);
      return new Date(dateStr) >= threeDaysAgo;
    }
  },
};
</script>

<style>
/* Tailwind line-clamp fallback */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Hover effect untuk artikel dan pengumuman */
li:hover {
  transform: translateY(-2px);
}

/* Prevent AOS overflow on mobile */
@media (max-width: 768px) {
  [data-aos="fade-left"] {
    transform: none !important;
    opacity: 1 !important;
  }
}
</style>