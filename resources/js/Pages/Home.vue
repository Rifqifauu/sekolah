<template>
  <!-- Hero Section -->
  <section class="border-b-8 border-red relative overflow-hidden" data-aos="fade-up">
    <div class="relative h-60 md:h-[28em] w-full">
      <template v-for="(img, index) in images" :key="index">
        <img v-if="img" :src="'/storage/' + img" alt="Hero Slide"
          class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000"
          :class="currentSlide === index ? 'opacity-100 z-10' : 'opacity-0 z-0'" />
      </template>
      <!-- Overlay -->
      <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent z-20"></div>

      <!-- Teks untuk Desktop -->
      <div
        class="hidden md:block absolute top-20 left-1/2 transform -translate-x-1/2 text-center text-white shadow-lg max-w-4xl px-4 z-30">
        <h1 class="text-3xl whitespace-nowrap md:text-6xl font-bold py-4">
          {{ page_setting?.judul_hero || 'Belum Ada Judul atau Nama Website' }}
        </h1>
        <p class="text-sm md:text-lg">
          {{ page_setting?.deskripsi_hero || 'Belum Ada Deskripsi' }}
        </p>
      </div>

      <!-- Navigasi panah -->
      <button @click="prevSlide"
        class="absolute top-1/2 left-4 transform -translate-y-1/2 z-40 text-white bg-green-200/30 hover:bg-green-200/60 p-2 rounded-full">
        ‹
      </button>
      <button @click="nextSlide"
        class="absolute top-1/2 right-4 transform -translate-y-1/2 z-40 text-white bg-green-200/30 hover:bg-green-200/60 p-2 rounded-full">
        ›
      </button>
    </div>

    <!-- Teks untuk Mobile -->
    <div class="block md:hidden bg-green-800 text-white p-4 text-left">
      <h1 class="text-xl font-bold">
        {{ page_setting?.judul_hero || 'Belum Ada Judul' }}
      </h1>
      <p class="text-sm mt-2">
        {{ page_setting?.deskripsi_hero || 'Belum Ada Deskripsi' }}
      </p>
    </div>
  </section>

  <!-- Floating Statistics -->
  <div class="relative md:pt-0 pt-6 md:-mt-24 md:mb-10 z-20">
    <div class="container mx-auto px-4">
      <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
          <!-- Siswa Aktif -->
          <div data-aos="fade-right"
            class="text-center group bg-white rounded-2xl shadow-2xl p-4 md:p-6 border border-green-100">
            <div
              class="text-green-800 mb-3 text-3xl md:text-5xl transform group-hover:scale-110 transition-transform duration-300">
              <a href="/siswa"><i class="fas fa-user-graduate"></i></a>
            </div>
            <div class="text-xl md:text-3xl font-bold text-green-800 mb-1">{{ siswa }}</div>
            <div class="text-green-600 text-sm md:text-base font-medium">Siswa Aktif</div>
          </div>

          <!-- pelatih -->
          <div data-aos="fade-down"
            class="text-center group bg-white rounded-2xl shadow-2xl p-4 md:p-6 border border-green-100">
            <div
              class="text-green-800 mb-3 text-3xl md:text-5xl transform group-hover:scale-110 transition-transform duration-300">
              <a href="/guru"><i class="fa-solid fa-chalkboard-user"></i></a>
            </div>
            <div class="text-xl md:text-3xl font-bold text-green-800 mb-1">{{ guru }}</div>
            <div class="text-green-600 text-sm md:text-base font-medium">Guru</div>
          </div>

          <!-- warga -->
          <div data-aos="fade-down"
            class="text-center group bg-white rounded-2xl shadow-2xl p-4 md:p-6 border border-green-100">
            <div
              class="text-green-800 mb-3 text-3xl md:text-5xl transform group-hover:scale-110 transition-transform duration-300">
              <a href="/staf"><i class="fas fa-users-between-lines"></i></a>
            </div>
            <div class="text-xl md:text-3xl font-bold text-green-800 mb-1">{{ staf }}</div>
            <div class="text-green-600 text-sm md:text-base font-medium">Staf</div>
          </div>

          <!-- Ekstrakurikuler -->
          <div data-aos="fade-left"
            class="text-center group bg-white rounded-2xl shadow-2xl p-4 md:p-6 border border-green-100">
            <div
              class="text-green-800 mb-3 text-3xl md:text-5xl transform group-hover:scale-110 transition-transform duration-300">
              <a href="/ekstrakurikuler"><i class="fas fa-theater-masks"></i></a>
            </div>
            <div class="text-xl md:text-3xl font-bold text-green-800 mb-1">{{ ekstrakurikuler.length }}</div>
            <div class="text-green-600 text-sm md:text-base font-medium">Ekstrakurikuler</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Social Media Links -->
  <div class="group fixed top-1/2 right-2 transform -translate-y-1/2 z-50" data-aos="fade-left">
    <div class="transition-all duration-300 transform translate-x-5 group-hover:translate-x-0 flex flex-col gap-4">
      <a href="https://www.instagram.com/smk.nusaka?igsh=dzYzajdtZDVidjk4" target="_blank"
        class="flex items-center justify-center w-12 h-12 md:w-18 md:h-18 bg-green-800 text-white hover:text-green-800 rounded-l-lg shadow-lg hover:bg-white transition-colors duration-300"
        data-aos="fade-left" data-aos-delay="100" aria-label="Instagram">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="https://youtube.com/@doekoen_official?si=dGBZgr-UMgqTe9kl" target="_blank"
        class="flex items-center justify-center w-12 h-12 md:w-18 md:h-18 bg-green-800 text-white hover:text-green-800 rounded-l-lg shadow-lg hover:bg-white transition-colors duration-300"
        data-aos="fade-left" data-aos-delay="200" aria-label="WhatsApp">
        <i class="fab fa-youtube"></i>
      </a>
      <a href="https://www.tiktok.com/@tjkt.nusaka.official?_t=ZS-8xorSOjUg0A&_r=1" target="_blank"
        class="flex items-center justify-center w-12 h-12 md:w-18 md:h-18 bg-green-800 text-white hover:text-green-800 rounded-l-lg shadow-lg hover:bg-white transition-colors duration-300"
        data-aos="fade-left" data-aos-delay="300" aria-label="TikTok">
        <i class="fab fa-tiktok"></i>
      </a>
    </div>
  </div>

  <!-- Profil Sekolah -->
  <section class="bg-white px-8 py-8 md:px-10 md:py-8" data-aos="fade-up">
    <h1 class="text-center text-green-800 pb-5 text-3xl md:text-4xl font-bold mb-8 border-b-4 border-green-800">
      Profil Organisasi
    </h1>

    <!-- Tombol Toggle -->
    <div class="flex justify-center gap-4 mb-10">
      <button @click="activeProfile = 'sejarah'" :class="[
        'px-6 py-2 border-2 rounded-full font-semibold transition-all duration-300',
        activeProfile === 'sejarah' ? 'bg-green-800 text-white border-red' : 'text-green-800 border-red hover:bg-green-800 hover:text-white'
      ]">
        Sejarah
      </button>
      <button @click="activeProfile = 'visi_misi'" :class="[
        'px-6 py-2 border-2 rounded-full font-semibold transition-all duration-300',
        activeProfile === 'visi_misi' ? 'bg-green-800 text-white border-red' : 'text-green-800 border-red hover:bg-green-800 hover:text-white'
      ]">
        Visi & Misi
      </button>
    </div>

    <!-- Konten Sejarah -->
    <transition name="fade">
      <div v-show="activeProfile === 'sejarah'"
        class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16">
        <!-- Slider Gambar -->
        <div class="relative w-full h-52 md:h-96 overflow-hidden rounded-2xl shadow-xl" data-aos="zoom-in-right">
          <div class="w-full h-full relative">
            <template v-for="(img, index) in profilimages" :key="index">
              <img v-if="img" :src="'/storage/' + img" alt="Foto Sekolah"
                class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000"
                :class="currentprofilSlide === index ? 'opacity-100 z-10' : 'opacity-0 z-0'" />
            </template>
          </div>

          <!-- Tombol navigasi -->
          <button @click="prevprofilSlide"
            class="absolute top-1/2 left-4 transform -translate-y-1/2 z-20 text-white bg-green-200/30 hover:bg-green-200/60 p-2 rounded-full">
            ‹
          </button>
          <button @click="nextprofilSlide"
            class="absolute top-1/2 right-4 transform -translate-y-1/2 z-20 text-white bg-green-200/30 hover:bg-green-200/60 p-2 rounded-full">
            ›
          </button>
        </div>

        <!-- Konten Teks -->
        <div class="flex flex-col gap-4" data-aos="fade-left" data-aos-delay="200">
          <h2 class="text-xl border-l-4 pl-4 border-green-800 md:text-2xl font-bold text-green-800">
            {{ page_setting?.judul_sejarah ?? 'Belum Ada Judul Sejarah' }}
          </h2>
          <p class="text-justify text-sm md:text-base text-black">
            {{ page_setting?.deskripsi_sejarah ?? 'Belum Ada Deskripsi Sejarah' }}
          </p>
        </div>
      </div>
    </transition>



    <!-- Konten Visi Misi -->
    <transition name="fade">
      <div v-show="activeProfile === 'visi_misi'"
        class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">

        <!-- Visi -->
        <div
          class="bg-white border-l-4 border-green-800 shadow-lg rounded-xl p-6 flex flex-col gap-4 hover:shadow-xl transition-shadow duration-300"
          data-aos="fade-right" data-aos-delay="150">
          <div class="flex items-center gap-3">
            <i class="fas fa fa-star text-green-800 text-xl"></i>
            <h2 class="text-2xl md:text-2xl font-bold text-green-800">Visi</h2>
          </div>
          <p class="text-black text-justify text-sm md:text-base whitespace-pre-line">
            {{ page_setting?.visi }}
          </p>
        </div>

        <!-- Misi -->
        <div
          class="bg-white border-l-4 border-green-800 shadow-lg rounded-xl p-6 flex flex-col gap-4 hover:shadow-xl transition-shadow duration-300"
          data-aos="fade-left" data-aos-delay="200">
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-list text-green-800 text-xl"></i>
            <h2 class="text-2xl md:text-2xl font-bold text-green-800">Misi</h2>
          </div>
          <div class="prose text-black text-sm md:text-base leading-relaxed text-justify"
            v-html="page_setting?.misi">
          </div>
        </div>

      </div>
    </transition>
  </section>

  <!-- Artikel Populer -->
  <section class="bg-green-800 border-t-8 border-green-800 px-4 py-12" data-aos="fade-up">
    <div class="container mx-auto">
      <h2 class="text-center text-white text-2xl md:text-3xl mb-8 font-bold" data-aos="fade-down">
        Artikel Populer
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="(artikel, index) in popularArticles" :key="artikel.id"
          class="relative bg-white/20 border border-white/30 rounded-lg shadow-lg p-4 h-full flex flex-col"
          data-aos="zoom-in" :data-aos-delay="(index + 1) * 100">
          <div
            class="absolute right-5 top-5 bg-white rounded-full py-1 px-3 text-sm text-green-800 flex items-center gap-1">
            <i class="fa fa-eye"></i> <span>{{ artikel.view_count }}</span>
          </div>

          <div class="aspect-[3/2] w-full mb-3 rounded-lg overflow-hidden">
            <img class="w-full h-full object-cover"
              :src="artikel.gambar ? '/storage/' + artikel.gambar : '/storage/placeholder.png'" :alt="artikel.judul" />
          </div>

          <h3 class="text-white font-bold text-lg mb-2">
            {{ artikel.judul }}
          </h3>

          <p class="text-sm text-white/70 mb-4 flex-grow">
            {{ artikel.excerpt ?? stripHtml(artikel.isi).slice(0, 100) + '...' }}
          </p>

          <a :href="`/artikel/${artikel.slug}`"
            class="group self-end mb-2 mt-auto inline-flex items-center gap-2 px-3 py-2 text-sm text-white bg-green-800 hover:bg-white hover:text-green-800 transition-all duration-300 rounded-full">
            <span>Selengkapnya</span>
            <i
              class="fa-solid fa-arrow-right transform transition-transform duration-300 group-hover:translate-x-1"></i>
          </a>
        </div>
      </div>

      <div class="mt-8 text-center" data-aos="fade-up">
        <a href="/artikel"
          class="inline-block text-white border border-white px-6 py-2 rounded-full hover:bg-white hover:text-green-800 transition duration-300">
          Lihat Artikel Lainnya
        </a>
      </div>
    </div>
  </section>

  <!-- Pengumuman -->
  <section class="bg-white border-t-8 border-green-800 px-4 py-12" data-aos="fade-up">
    <div class="container mx-auto">
      <h2 class="text-center text-green-800 text-2xl md:text-3xl mb-8 font-bold" data-aos="fade-down">
        Pengumuman Terbaru
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl mx-auto">
        <div v-for="(item, index) in pengumuman" :key="item.id"
          class="border border-green-200 p-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
          <div class="mb-3">
            <h3 class="text-lg font-bold text-green-800 mb-1">
              {{ item.judul }}
            </h3>
            <span class="text-sm text-gray-500 block">{{ item.created_at_formatted }}</span>
          </div>
          <p class="text-sm text-black mb-4">
            {{ item.isi.split(' ').slice(0, 15).join(' ') + '...' }}
          </p>
          <a :href="`/pengumuman/${item.id}`"
            class="inline-flex items-center px-3 py-1 text-sm bg-green-800 text-white rounded-full hover:bg-white hover:text-green-800 border border-green-800 transition-all duration-300">
            Lihat <i class="fa-solid fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>

      <div class="mt-8 text-center" data-aos="fade-up">
        <a href="/pengumuman"
          class="inline-block text-green-800 border border-green-800 px-6 py-2 rounded-full hover:bg-green-800 hover:text-white transition duration-300">
          Lihat Pengumuman Lainnya
        </a>
      </div>
    </div>
  </section>

  <!-- Ekstrakurikuler -->
  <section class="bg-white border-t-8 border-green-800 px-4 py-12" data-aos="fade-up">
    <div class="container mx-auto">
      <h2 class="text-center text-green-800 text-2xl md:text-3xl mb-8 font-bold">Ekstrakurikuler</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
        <div v-for="(item, index) in ekstrakurikuler" :key="item.id"
          class="bg-green-50 border border-green-100 rounded-xl shadow hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col">
          <div class="h-48 overflow-hidden">
            <img class="w-full h-full object-cover"
              :src="item.gambar ? '/storage/' + item.gambar : '/storage/placeholder.png'" :alt="item.nama" />
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-green-800 mb-2">{{ item.nama }}</h3>
            <p class="text-sm text-balack">
              {{ truncateWords(item.deskripsi, 15) }}
            </p>
          </div>
        </div>
      </div>

      <div class="mt-8 text-center" data-aos="fade-up">
        <a href="/ekstrakurikuler"
          class="inline-block text-green-800 border border-green-800 px-6 py-2 rounded-full hover:bg-green-200 hover:text-black transition duration-300">
          Lihat Ekstrakurikuler Lainnya
        </a>
      </div>
    </div>
  </section>

<!-- Video Section -->
<section class="relative bg-gradient-to-br from-black to-green-800 px-4 py-16 overflow-hidden">
  <!-- Background abstract shapes -->
  <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10">
    <div class="absolute -top-20 -left-20 w-64 h-64 rounded-full bg-green-500"></div>
    <div class="absolute bottom-10 right-10 w-80 h-80 rounded-full bg-green-400"></div>
    <div class="absolute top-1/3 right-1/4 w-40 h-40 rounded-full bg-orange-500"></div>
  </div>

  <!-- Diagonal pattern overlay -->
  <div class="absolute inset-0 opacity-5"
    style="background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 50%, #fff 50%, #fff 75%, transparent 75%, transparent); background-size: 10px 10px;">
  </div>

  <!-- Content -->
  <div class="relative max-w-3xl mx-auto text-left md:text-center">
    <!-- Badge -->
    <div class="text-green-700 inline-block mb-3 px-4 py-1 bg-white rounded-full font-bold text-sm" data-aos="fade-down-left">
      MENGENAL LEBIH JAUH
    </div>

    <!-- Title -->
    <h2 class="text-white text-3xl md:text-5xl font-extrabold mb-4 drop-shadow-lg" data-aos="fade-up-right">
      {{ page_setting?.judul_video ? page_setting.judul_video : 'Belum Ada Judul Video' }}
    </h2>

    <!-- Description -->
    <p class="text-green-100 mb-8 max-w-2xl mx-auto" data-aos="fade-up">
      {{ page_setting?.deskripsi_video ? page_setting.deskripsi_video : 'Belum Ada Deskripsi Video' }}
    </p>

    <!-- Video player -->
    <div class="relative mb-8" data-aos="flip-left">
      <!-- Glow effect -->
      <div class="absolute -inset-2 bg-gradient-to-tr from-green-400 via-green-500 to-black rounded-xl opacity-75 blur-sm"></div>

      <!-- Video iframe or placeholder -->
      <div>
        <div class="relative aspect-w-16 aspect-h-9 rounded-xl overflow-hidden shadow-2xl border-4 border-white/10">
          <iframe v-if="videos.length" class="w-full h-full" :src="videos[currentVideoIndex]"
            title="Video Profil SMK Nusaka" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
          <div v-else class="w-full h-full flex items-center justify-center bg-green-200 text-green-600">
            Belum Ada Video Profil
          </div>
        </div>
      </div>
    </div>
  </div>






  <!-- Decorative elements -->
  <div class="hidden md:block absolute -bottom-10 -left-10 w-40 h-40 bg-green-200 rounded-full opacity-50"></div>
  <div class="hidden md:block absolute -top-20 -right-20 w-60 h-60 bg-green-600 rounded-full opacity-30"></div>
</section>

</template>

<script>
import AOS from 'aos'
import 'aos/dist/aos.css'
import AppLayout from '../layouts/AppLayout.vue'
import { ref, onMounted, computed } from 'vue'

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

  setup(props) {
    const activeProfile = ref('sejarah')
    const videos = ref([
      props.page_setting?.url_video,
      props.page_setting?.url_video1,
      props.page_setting?.url_video2,
    ].filter(Boolean))

    const currentVideoIndex = ref(0)
const prevvideoIndex = () => {
  currentVideoIndex.value =
    (currentVideoIndex.value - 1 + videos.value.length) % videos.value.length
}

const nextvideoIndex = () => {
  currentVideoIndex.value =
    (currentVideoIndex.value + 1) % videos.value.length
}

    const images = ref([
      props.page_setting?.gambar_hero,
      props.page_setting?.gambar_hero1,
      props.page_setting?.gambar_hero2,
    ].filter(Boolean)) // filter untuk hindari null

    const profilimages = computed(() => [
      props.page_setting?.gambar_sejarah,
      props.page_setting?.gambar_sejarah1,
      props.page_setting?.gambar_sejarah2,
    ].filter(Boolean)) // filter untuk hindari null

    const currentSlide = ref(0)
    const currentprofilSlide = ref(0)

    const nextprofilSlide = () => {
      currentprofilSlide.value = (currentprofilSlide.value + 1) % profilimages.value.length
    }

    const prevprofilSlide = () => {
      currentprofilSlide.value = (currentprofilSlide.value - 1 + profilimages.value.length) % profilimages.value.length
    }
    const nextSlide = () => {
      currentSlide.value = (currentSlide.value + 1) % images.value.length
    }

    const prevSlide = () => {
      currentSlide.value = (currentSlide.value - 1 + images.value.length) % images.value.length
    }

    onMounted(() => {
      document.title = props.title
      console.log(props.pengumuman)
      console.log(props.guru)
      console.log(props.page_setting)
      AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
        offset: 50,
        delay: 100,
      })

      if (images.value.length > 1) {
        setInterval(nextSlide, 5000)
      }

      if (profilimages.value.length > 1) {
        setInterval(nextprofilSlide, 5000)
      }
      window.addEventListener('scroll', handleScroll)
    })

    const handleScroll = () => {
      // Scroll handler if needed
    }

    return {
      activeProfile,
      images,
      profilimages,
      currentSlide,
      nextSlide,
      prevSlide,
      currentprofilSlide,
      nextprofilSlide,
      prevprofilSlide,
      videos,
      currentVideoIndex,
       nextvideoIndex,
      prevvideoIndex,
    }
  },

  beforeUnmount() {
    window.removeEventListener('scroll', this.handleScroll)
  },

  methods: {
    stripHtml(html) {
      const temp = document.createElement('div')
      temp.innerHTML = html
      return temp.textContent || temp.innerText || ''
    },

    truncateWords(text, limit) {
      if (!text) return ''
      const words = text.split(' ')
      if (words.length <= limit) return text
      return words.slice(0, limit).join(' ') + '...'
    },
  },

  layout: AppLayout,
}
</script>


<style scoped>
/* Custom animations */
@keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}

@keyframes slideUp {
  from {
    transform: translateY(20px);
    opacity: 0;
  }

  to {
    transform: translateY(0);
    opacity: 1;
  }
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

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
body {
  overflow-x: hidden;
}

</style>
