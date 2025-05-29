<template>
  <div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
      <div class="flex flex-col lg:flex-row gap-8">

        <!-- Konten Utama -->
        <main class="w-full lg:w-2/3 bg-white p-6 rounded-xl shadow-sm" data-aos="fade-up">
          <!-- Breadcrumb -->
          <div class="flex items-center gap-2 mb-4 text-sm text-gray-600">
            <a href="/" class="flex items-center hover:text-red-700 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              Beranda
            </a>
            <span class="hidden md:block">/</span>
            <span class="hidden md:block text-gray-500 break-words max-w-full md:max-w-full">
              {{ showpengumuman.judul }}
            </span>
          </div>

          <!-- Judul Pengumuman -->
          <h1 class="text-2xl md:text-4xl font-extrabold mb-6 text-red-800">
            {{ showpengumuman.judul }}
          </h1>

          <!-- Isi Pengumuman -->
          <div class="prose prose-p:mb-6 prose-p:leading-relaxed max-w-full text-gray-800 article-content" v-html="showpengumuman.isi"></div>
          <!-- PDF Viewer -->
<div v-if="showpengumuman.file" class="mt-8">
  <h2 class="text-lg font-semibold mb-4 text-gray-700">File Lampiran </h2>
  <div class="aspect-w-16 aspect-h-9 w-full border rounded-xl overflow-hidden shadow">
    <iframe
      :src="`/storage/${showpengumuman.file}`"
      type="application/pdf"
      class="w-full h-full"
      frameborder="0"
    ></iframe>
  </div>
</div>

        </main>
        <!-- Sidebar -->
          <Side :popularArticles="popularArticles" :pengumuman="pengumuman" />

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
    showpengumuman: Object,     
    popularArticles: Array,   
    pengumuman: Array,
  },   
  mounted() {     
    document.title = this.showpengumuman.judul;          
    
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

/* Solusi 2: Target langsung elemen di dalam konten showpengumuman */
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

/* Style populer showpengumuman */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>