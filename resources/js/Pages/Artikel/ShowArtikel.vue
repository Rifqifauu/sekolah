<template>
   <div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
      <div class="flex flex-col lg:flex-row gap-8">
         <main class="w-full lg:w-2/3 bg-white p-6 rounded-xl shadow-sm" data-aos="fade-up">
          <!-- Breadcrumb -->
          <div class="flex items-center gap-2 mb-4 text-sm text-gray-600">
            <a href="/" class="flex items-center hover:text-red-700 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              Beranda
            </a>
        <span>/</span>
        <span class="text-gray-500">{{ artikel.kategori?.nama || 'Artikel' }}</span>
        <span class="hidden md:block">/</span>
        <span class="hidden md:block text-gray-500 break-words  md:max-w-full">{{ artikel.judul }}</span>
      </div>

      <div class="mb-4">
        <span class="bg-red-100 text-red-800 text-xs font-medium px-3 py-1 rounded-full">
          {{ artikel.kategori || 'Uncategorized' }}
        </span>
      </div>

      <h1 class="text-2xl md:text-4xl font-extrabold mb-6 text-red-800">{{ artikel.judul }}</h1>

      <div class="aspect-w-3 aspect-h-2 mb-6 rounded-lg overflow-hidden shadow-sm" data-aos="zoom-in" data-aos-delay="200">
        <img
          :src="`/storage/${artikel.gambar}`"
          alt="Gambar Artikel"
          class="object-cover w-full h-full"
        />
      </div>

      <div class="prose prose-p:mb-6 prose-p:leading-relaxed max-w-full md:max-w-none text-gray-800 article-content" v-html="artikel.isi"></div>
</main>
    <Side  :popularArticles="popularArticles" :pengumuman="pengumuman" />
  </div>
    </div>
    </div>
</template>


<script> 
import AOS from 'aos'; 
import 'aos/dist/aos.css';
import Side from '../../components/Side.vue' 
import AppLayout from '@/layouts/AppLayout.vue';  

export default {   
  components:{
    Side
  },
  props: {     
    artikel: Object,     
    popularArticles: Array,   
    pengumuman: Array,
  },   
  mounted() {     
    document.title = this.artikel.judul;          
    
    AOS.init({       
      duration: 1000,       
      easing: 'ease-in-out',       
      once: true,       
      offset: 50,       
      delay: 100,       
      disable: window.innerWidth < 768 ? 'phone' : false,     
    });          
    
    window.addEventListener('scroll', this.handleScroll);   
  },   
  beforeUnmount() {     
    window.removeEventListener('scroll', this.handleScroll);   
  },   
  methods: {     
    handleScroll() {       
      // Optional scroll logic     
    },   
  },   
  layout: AppLayout, 
}; 
</script>  

<style>
/* Solusi 1: Gunakan prose modifiers dari Tailwind Typography */
.prose p {
  margin-bottom: 1.5rem !important;
  line-height: 1.8 !important;
}

/* Solusi 2: Target langsung elemen di dalam konten artikel */
.article-content p {
  margin-top: 0;
  margin-bottom: 1.5rem;
  line-height: 1.8;
}

.article-content h2,
.article-content h3,
.article-content h4 {
  margin-top: 2rem;
  margin-bottom: 1rem;
}

.article-content img {
  margin: 1.5rem 0;
}

/* Style populer artikel */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>