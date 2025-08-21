<template>
  <div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
      <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
          <div
            class="w-full md:w-2/3 contact-page max-w-full mx-auto bg-green-950 text-white rounded-xl sm:rounded-3xl py-3 sm:py-5 px-3 sm:px-6 shadow-xl"
          >
            <!-- Judul Kontak -->
            <h1
              class="text-center text-xl sm:text-3xl font-bold text-white drop-shadow-lg mb-3 sm:mb-6"
              data-aos="fade-down"
            >
              Kontak
            </h1>

            <!-- Peta -->
            <div
              class="bg-white/10 backdrop-blur-lg rounded-lg sm:rounded-2xl p-2 sm:p-4 shadow-xl border border-white/20 mb-3 sm:mb-5"
              data-aos="fade-up"
            >
              <h2
                class="flex items-center gap-2 text-lg sm:text-xl font-semibold text-green-300 mb-2"
              >
                <i
                  class="fas fa-map text-white bg-green-950 rounded-full p-1 shadow-md"
                ></i>
                Peta Lokasi
              </h2>
              <div
                class="rounded-lg overflow-hidden border border-green-950 shadow-lg h-48 sm:h-auto sm:aspect-[16/9]"
              >
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.377395243864!2d108.8889459!3d-7.0821726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f9f27fb3d5923%3A0x46acc110371786cd!2sSMK%20Ma&#39;arif%20NU%2001%20Ketanggungan!5e0!3m2!1sen!2sid!4v1751856835175!5m2!1sen!2sid"
                  class="w-full h-full border-0"
                  allowfullscreen=""
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
              </div>
            </div>

            <!-- Info Kontak -->
            <div
              class="bg-white/10 backdrop-blur-lg rounded-lg sm:rounded-2xl p-2 sm:p-4 shadow-xl border border-white/20 space-y-3 sm:space-y-4"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <div>
                <h2
                  class="flex items-center gap-2 text-base sm:text-lg font-semibold text-green-300"
                >
                  <i
                    class="fas fa-map-marker-alt text-white bg-green-950 p-1 rounded-full shadow-md text-xs sm:text-sm"
                  ></i>
                  Alamat
                </h2>
                <p class="pl-6 sm:pl-8 mt-1 text-gray-200 text-xs sm:text-sm leading-snug">
                 Sindangjaya,  Kec. Ketanggungan,  <br> Kabupaten Brebes, Jawa Tengah

                </p>
              </div>

              <div>
                <h2
                  class="flex items-center gap-2 text-base sm:text-lg font-semibold text-green-300"
                >
                  <i
                    class="fas fa-envelope text-white bg-green-950 p-1 rounded-full shadow-md text-xs sm:text-sm"
                  ></i>
                  Facebook
                </h2>
                <a
                  href="https://www.facebook.com/share/197t3s6eYT/"
                  class="pl-6 sm:pl-8 mt-1 block text-gray-300 hover:text-green-100 transition-colors duration-200 text-xs sm:text-sm break-all"
                  >SMKNUSAKA</a
                >
              </div>

              <div>
                <h2
                  class="flex items-center gap-2 text-base sm:text-lg font-semibold text-green-300"
                >
                  <i
                    class="fab fa-whatsapp text-white bg-green-950 p-1 rounded-full shadow-md text-xs sm:text-sm"
                  ></i>
                  Whatsapp
                </h2>
                <a
                  href="https://wa.me/6283188555556"
                  class="pl-6 sm:pl-8 mt-1 block text-gray-300 hover:text-green-100 transition-colors duration-200 text-xs sm:text-sm"
                  >+62 831-8855-5556</a
                >
              </div>
            </div>
          </div>
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
});
onMounted(() => {
  document.title = 'Kontak';
});
</script>
