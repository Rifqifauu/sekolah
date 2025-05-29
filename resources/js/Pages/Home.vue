<template>
  <!-- Hero Section -->
  <section class="border-b-8 border-red-700 relative overflow-hidden h-60 md:h-[28em]" data-aos="fade-up">
    <div class="w-full h-full">
      <img 
        :src="'/storage/' + page_setting.gambar_hero"
        alt="Hero Image" 
        class="w-full h-full object-cover"
      />
      <!-- Overlay -->
      <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
    </div>
    <div class="absolute top-1/2 md:top-44 left-8 md:left-1/2 transform md:-translate-x-1/2 -translate-y-1/2 text-left md:text-center text-white shadow-lg max-w-[90%] md:max-w-4xl">
      <h1 class="text-3xl md:whitespace-nowrap md:text-6xl font-bold py-4">
        {{ page_setting.judul_hero }}
      </h1>
      <p class="text-sm md:text-lg">
        {{ page_setting.deskripsi_hero }}
      </p>
    </div>
  </section>

  <!-- Floating Statistics -->
  <div class="relative md:pt-0 pt-6 md:-mt-24 md:mb-10 z-20">
    <div class="container mx-auto px-4">
      <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
          <!-- Siswa Aktif -->
          <div data-aos="fade-right" class="text-center group bg-white rounded-2xl shadow-2xl p-4 md:p-6 border border-gray-100">
            <div class="text-red-700 mb-3 text-3xl md:text-5xl transform group-hover:scale-110 transition-transform duration-300">
              <i class="fas fa-user-graduate"></i>
            </div>
            <div class="text-xl md:text-3xl font-bold text-gray-800 mb-1">{{ siswa }}</div>
            <div class="text-gray-600 text-sm md:text-base font-medium">Siswa Aktif</div>
          </div>

          <!-- Guru -->
          <div data-aos="fade-down" class="text-center group bg-white rounded-2xl shadow-2xl p-4 md:p-6 border border-gray-100">
            <div class="text-red-700 mb-3 text-3xl md:text-5xl transform group-hover:scale-110 transition-transform duration-300">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="text-xl md:text-3xl font-bold text-gray-800 mb-1">{{ guru }}</div>
            <div class="text-gray-600 text-sm md:text-base font-medium">Guru</div>
          </div>

          <!-- Staf -->
          <div data-aos="fade-down" class="text-center group bg-white rounded-2xl shadow-2xl p-4 md:p-6 border border-gray-100">
            <div class="text-red-700 mb-3 text-3xl md:text-5xl transform group-hover:scale-110 transition-transform duration-300">
              <i class="fas fa-users-cog"></i>
            </div>
            <div class="text-xl md:text-3xl font-bold text-gray-800 mb-1">{{ staf }}</div>
            <div class="text-gray-600 text-sm md:text-base font-medium">Staf Kependidikan</div>
          </div>

          <!-- Ekstrakurikuler -->
          <div data-aos="fade-left" class="text-center group bg-white rounded-2xl shadow-2xl p-4 md:p-6 border border-gray-100">
            <div class="text-red-700 mb-3 text-3xl md:text-5xl transform group-hover:scale-110 transition-transform duration-300">
              <i class="fas fa-theater-masks"></i>
            </div>
            <div class="text-xl md:text-3xl font-bold text-gray-800 mb-1">{{ ekstrakurikuler.length }}</div>
            <div class="text-gray-600 text-sm md:text-base font-medium">Ekstrakurikuler</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Social Media Links -->
  <div class="group fixed top-1/2 right-2 transform -translate-y-1/2 z-50" data-aos="fade-left">
    <div class="transition-all duration-300 transform translate-x-5 group-hover:translate-x-0 flex flex-col gap-4">
      <a 
        href="https://instagram.com" 
        target="_blank"
        class="flex items-center justify-center w-12 h-12 md:w-18 md:h-18 bg-red-800 text-white hover:text-red-800 rounded-l-lg shadow-lg hover:bg-white transition-colors duration-300"
        data-aos="fade-left" 
        data-aos-delay="100"
        aria-label="Instagram"
      >
        <i class="fab fa-instagram"></i>
      </a>
      <a 
        href="https://wa.me/6281234567890" 
        target="_blank"
        class="flex items-center justify-center w-12 h-12 md:w-18 md:h-18 bg-red-800 text-white hover:text-red-800 rounded-l-lg shadow-lg hover:bg-white transition-colors duration-300"
        data-aos="fade-left" 
        data-aos-delay="200"
        aria-label="WhatsApp"
      >
        <i class="fab fa-whatsapp"></i>
      </a>
      <a 
        href="https://tiktok.com" 
        target="_blank"
        class="flex items-center justify-center w-12 h-12 md:w-18 md:h-18 bg-red-800 text-white hover:text-red-800 rounded-l-lg shadow-lg hover:bg-white transition-colors duration-300"
        data-aos="fade-left" 
        data-aos-delay="300"
        aria-label="TikTok"
      >
        <i class="fab fa-tiktok"></i>
      </a>
    </div>
  </div>

<!-- Profil Sekolah -->
<section class="bg-white px-8 py-8 md:px-10 md:py-8" data-aos="fade-up">
  <h1 class="text-center text-red-800 pb-5 text-3xl md:text-4xl font-bold mb-8 border-b-4 border-red-800">
    Profil Sekolah
  </h1>

  <!-- Tombol Toggle -->
  <div class="flex justify-center gap-4 mb-10">
    <button 
      @click="activeProfile = 'sejarah'"
      :class="[
        'px-6 py-2 border-2 rounded-full font-semibold transition-all duration-300',
        activeProfile === 'sejarah' ? 'bg-red-800 text-white border-red-800' : 'text-red-800 border-red-800 hover:bg-red-800 hover:text-white'
      ]"
    >
      Sejarah
    </button>
    <button 
      @click="activeProfile = 'visi_misi'"
      :class="[
        'px-6 py-2 border-2 rounded-full font-semibold transition-all duration-300',
        activeProfile === 'visi_misi' ? 'bg-red-800 text-white border-red-800' : 'text-red-800 border-red-800 hover:bg-red-800 hover:text-white'
      ]"
    >
      Visi & Misi
    </button>
  </div>

  <!-- Konten Sejarah -->
  <transition name="fade">
    <div v-show="activeProfile === 'sejarah'" class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16">
      <div class="w-full h-54 md:h-auto" data-aos="zoom-in-right">
        <img 
          :src="'/storage/' + page_setting.gambar_sejarah"
          alt="Foto Sekolah"
          class="w-full h-full object-cover rounded-2xl shadow-xl"
        />
      </div>
      <div class="flex flex-col gap-4" data-aos="fade-left" data-aos-delay="200">
        <h2 class="text-xl border-l-4 pl-4 border-red-800 md:text-2xl font-bold text-red-800">
          {{ page_setting.judul_sejarah }}
        </h2>
        <p class="text-justify text-sm md:text-base text-gray-700">
          {{ page_setting.deskripsi_sejarah }}
        </p>
      </div>
    </div>
  </transition>

  <!-- Konten Visi Misi -->
  <transition name="fade">
    <div v-show="activeProfile === 'visi_misi'" class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
      
      <!-- Visi -->
      <div
        class="bg-white border-l-4 border-red-700 shadow-lg rounded-xl p-6 flex flex-col gap-4 hover:shadow-xl transition-shadow duration-300"
        data-aos="fade-right" data-aos-delay="150"
      >
        <div class="flex items-center gap-3">
          <i class="fas fa fa-star text-red-800 text-xl"></i>
          <h2 class="text-2xl md:text-2xl font-bold text-red-700">Visi</h2>
        </div>
        <p class="text-gray-700 text-justify text-sm md:text-base whitespace-pre-line">
          {{ page_setting?.visi }}
        </p>
      </div>

      <!-- Misi -->
      <div
        class="bg-white border-l-4 border-red-700 shadow-lg rounded-xl p-6 flex flex-col gap-4 hover:shadow-xl transition-shadow duration-300"
        data-aos="fade-left" data-aos-delay="200"
      >
        <div class="flex items-center gap-3">
          <i class="fa-solid fa-list text-red-800 text-xl"></i>
          <h2 class="text-2xl md:text-2xl font-bold text-red-700">Misi</h2>
        </div>
        <div class="prose text-gray-700 text-sm md:text-base leading-relaxed text-justify" v-html="page_setting?.misi"></div>
      </div>

    </div>
  </transition>
</section>

  <!-- Artikel Populer -->
  <section class="bg-red-800 border-t-8 border-red-700 px-4 py-12" data-aos="fade-up">
    <div class="container mx-auto">
      <h2 class="text-center text-white text-2xl md:text-3xl mb-8 font-bold" data-aos="fade-down">
        Artikel Populer
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="(artikel, index) in popularArticles"
          :key="artikel.id"
          class="relative bg-white/20 border border-white/30 rounded-lg shadow-lg p-4 h-full flex flex-col"
          data-aos="zoom-in"
          :data-aos-delay="(index + 1) * 100"
        >
          <div class="absolute right-5 top-5 bg-white rounded-full py-1 px-3 text-sm text-red-800 flex items-center gap-1">
            <i class="fa fa-eye"></i> <span>{{ artikel.view_count }}</span>
          </div>

          <div class="aspect-[3/2] w-full mb-3 rounded-lg overflow-hidden">
            <img
              class="w-full h-full object-cover"
              :src="artikel.gambar ? '/storage/' + artikel.gambar : '/storage/foto-sekolah.png'"
              :alt="artikel.judul"
            />
          </div>

          <h3 class="text-white font-bold text-lg mb-2">
            {{ artikel.judul }}
          </h3>

          <p class="text-sm text-white/70 mb-4 flex-grow">
            {{ artikel.excerpt ?? stripHtml(artikel.isi).slice(0, 100) + '...' }}
          </p>

          <a
            :href="`/artikel/${artikel.slug}`"
            class="group self-end mb-2 mt-auto inline-flex items-center gap-2 px-3 py-2 text-sm text-red-800 bg-yellow-500 hover:bg-white hover:text-red-800 transition-all duration-300 rounded-full"
          >
            <span>Selengkapnya</span>
            <i class="fa-solid fa-arrow-right transform transition-transform duration-300 group-hover:translate-x-1"></i>
          </a>
        </div>
      </div>

      <div class="mt-8 text-center" data-aos="fade-up">
        <a href="/artikel" class="inline-block text-white border border-white px-6 py-2 rounded-full hover:bg-white hover:text-red-800 transition duration-300">
          Lihat Artikel Lainnya
        </a>
      </div>
    </div>
  </section>

  <!-- Pengumuman -->
  <section class="bg-white border-t-8 border-red-700 px-4 py-12" data-aos="fade-up">
    <div class="container mx-auto">
      <h2 class="text-center text-red-800 text-2xl md:text-3xl mb-8 font-bold" data-aos="fade-down">
        Pengumuman Terbaru
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl mx-auto">
        <div 
          v-for="(item, index) in pengumuman"
          :key="item.id" 
          class="border border-red-200 p-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300"
        >
          <div class="mb-3">
            <h3 class="text-lg font-bold text-red-800 mb-1">
              {{ item.judul }}
            </h3>
            <span class="text-sm text-gray-500 block">{{ item.created_at_formatted }}</span>
          </div>
          <p class="text-sm text-gray-700 mb-4">
            {{ item.isi.split(' ').slice(0, 15).join(' ') + '...' }}
          </p>
          <a 
            :href="`/pengumuman/${item.id}`"
            class="inline-flex items-center px-3 py-1 text-sm bg-red-800 text-white rounded-full hover:bg-white hover:text-red-800 border border-red-800 transition-all duration-300"
          >
            Lihat <i class="fa-solid fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>

      <div class="mt-8 text-center" data-aos="fade-up">
        <a href="/pengumuman" class="inline-block text-red-800 border border-red-800 px-6 py-2 rounded-full hover:bg-red-800 hover:text-white transition duration-300">
          Lihat Pengumuman Lainnya
        </a>
      </div>
    </div>
  </section>

  <!-- Ekstrakurikuler -->
  <section class="bg-white border-t-8 border-red-700 px-4 py-12" data-aos="fade-up">
    <div class="container mx-auto">
      <h2 class="text-center text-red-800 text-2xl md:text-3xl mb-8 font-bold">Ekstrakurikuler</h2>
      
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
        <div 
          v-for="(item, index) in ekstrakurikuler"
          :key="item.id"  
          class="bg-gray-50 border border-red-100 rounded-xl shadow hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col"
        >
          <div class="h-48 overflow-hidden">
            <img
              class="w-full h-full object-cover"
              :src="item.gambar ? '/storage/' + item.gambar : '/storage/foto-sekolah.png'"
              :alt="item.nama"
            />
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-red-800 mb-2">{{ item.nama }}</h3>
            <p class="text-sm text-gray-700">
              {{ truncateWords(item.deskripsi, 15) }}
            </p>
          </div>
        </div>
      </div>

      <div class="mt-8 text-center" data-aos="fade-up">
        <a href="/ekstrakurikuler" class="inline-block text-red-800 border border-red-800 px-6 py-2 rounded-full hover:bg-red-800 hover:text-white transition duration-300">
          Lihat Ekstrakurikuler Lainnya
        </a>
      </div>
    </div>
  </section>

  <!-- Video -->
  <section class="relative bg-gradient-to-br from-red-800 to-red-900 px-4 py-16 overflow-hidden">
    <!-- Abstract shapes for background interest -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10">
      <div class="absolute -top-20 -left-20 w-64 h-64 rounded-full bg-red-500"></div>
      <div class="absolute bottom-10 right-10 w-80 h-80 rounded-full bg-yellow-400"></div>
      <div class="absolute top-1/3 right-1/4 w-40 h-40 rounded-full bg-orange-500"></div>
    </div>
    
    <!-- Diagonal pattern overlay -->
    <div class="absolute inset-0 opacity-5" style="background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 50%, #fff 50%, #fff 75%, transparent 75%, transparent); background-size: 10px 10px;"></div>
    
    <div class="relative max-w-3xl mx-auto text-left md:text-center">
      <div class="inline-block mb-3 px-4 py-1 bg-yellow-500 text-red-900 rounded-full font-bold text-sm transform" data-aos="fade-down-left">
        MENGENAL LEBIH JAUH
      </div>
      
      <h2 class="text-white text-3xl md:text-5xl font-extrabold mb-4 drop-shadow-lg" data-aos="fade-up-right">
        {{ page_setting.judul_video }}
      </h2>
      
      <p class="text-red-100 mb-8 max-w-2xl mx-auto" data-aos="fade-up">
        {{ page_setting.deskripsi_video }}
      </p>
      
      <div class="relative mb-8" data-aos="flip-left">
        <!-- Video border decoration -->
        <div class="absolute -inset-2 bg-gradient-to-tr from-red-400 via-red-500 to-red-700 rounded-xl opacity-75 blur-sm"></div>
        
        <div class="relative aspect-w-16 aspect-h-9 rounded-xl overflow-hidden shadow-2xl border-4 border-white/10">
          <iframe
            class="w-full h-full"
            :src="page_setting.url_video"
            title="Video Profil SMA Lorem Ipsum"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
          </iframe>
        </div>
      </div>
    </div>
    
    <!-- Decorative elements -->
    <div class="hidden md:block absolute -bottom-10 -left-10 w-40 h-40 bg-red-700 rounded-full opacity-50"></div>
    <div class="hidden md:block absolute -top-20 -right-20 w-60 h-60 bg-red-600 rounded-full opacity-30"></div>
  </section>
</template>

<script>
import AOS from 'aos';
import 'aos/dist/aos.css';
import AppLayout from '../layouts/AppLayout.vue';
import { ref } from 'vue';

export default {
  props: {
    title: String,
    flash: Object,
    ekstrakurikuler: Object,
    popularArticles: Array,
    pengumuman: Object,
    guru: String,
    siswa: String,
    staf: String,
    page_setting: Object,
  },
  
  setup() {
    const activeProfile = ref('sejarah');
    
    return {
      activeProfile
    };
  },
  
  mounted() {
    // Set document title
    document.title = this.title;
    
    console.log(this.pengumuman);
    console.log(this.guru);
    console.log(this.page_setting);

    // Initialize AOS animation library
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      offset: 50,
      delay: 100,
      disable: window.innerWidth < 768 ? 'phone' : false // Disable on small screens for better performance
    });

    // Add scroll event listener
    window.addEventListener('scroll', this.handleScroll);
  },
  
  beforeUnmount() {
    // Clean up event listener
    window.removeEventListener('scroll', this.handleScroll);
  },
  
  methods: {
    handleScroll() {
      // Scroll handler can be implemented here if needed
      // For example, to show/hide navbar on scroll
    },
    
    stripHtml(html) {
      const temp = document.createElement('div');
      temp.innerHTML = html;
      return temp.textContent || temp.innerText || '';
    },
    
    truncateWords(text, limit) {
      if (!text) return '';
      const words = text.split(' ');
      if (words.length <= limit) return text;
      return words.slice(0, limit).join(' ') + '...';
    },
  },
  
  layout: AppLayout,
};
</script>

<style scoped>
/* Custom animations */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideUp {
  from { transform: translateY(20px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

/* Optional: Custom scrollbar for modern browsers */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
  background: #b91c1c;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: #7f1d1d;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
