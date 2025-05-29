<template>
  <div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
      <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
          <div
            class="w-full md:w-2/3 contact-page max-w-full mx-auto bg-red-800 text-white rounded-xl sm:rounded-3xl py-3 sm:py-5 px-3 sm:px-6 shadow-xl"
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
                class="flex items-center gap-2 text-lg sm:text-xl font-semibold text-red-300 mb-2"
              >
                <i
                  class="fas fa-map text-white bg-red-500 rounded-full p-1 shadow-md"
                ></i>
                Peta Lokasi
              </h2>
              <div
                class="rounded-lg overflow-hidden border border-red-500 shadow-lg h-48 sm:h-auto sm:aspect-[16/9]"
              >
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31650.119316460172!2d109.30045308096538!3d-7.435911363987128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6559814ade5b79%3A0xaef1b7bab5cba0f0!2sFaculty%20of%20Engineering%20Unsoed!5e0!3m2!1sen!2sid!4v1747721675490!5m2!1sen!2sid"
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
                  class="flex items-center gap-2 text-base sm:text-lg font-semibold text-red-300"
                >
                  <i
                    class="fas fa-map-marker-alt text-white bg-red-500 p-1 rounded-full shadow-md text-xs sm:text-sm"
                  ></i>
                  Alamat
                </h2>
                <p class="pl-6 sm:pl-8 mt-1 text-gray-200 text-xs sm:text-sm leading-snug">
                  Jl. Inovasi No. 88, Cyber City<br />
                  Email: info@loremipsum.sch.id<br />
                  Telp: (021) 987-6543
                </p>
              </div>

              <div>
                <h2
                  class="flex items-center gap-2 text-base sm:text-lg font-semibold text-red-300"
                >
                  <i
                    class="fas fa-envelope text-white bg-red-500 p-1 rounded-full shadow-md text-xs sm:text-sm"
                  ></i>
                  Email
                </h2>
                <a
                  href="mailto:smaloremipsum@go.id"
                  class="pl-6 sm:pl-8 mt-1 block text-red-300 hover:text-red-100 transition-colors duration-200 text-xs sm:text-sm break-all"
                  >smaloremipsum@go.id</a
                >
              </div>

              <div>
                <h2
                  class="flex items-center gap-2 text-base sm:text-lg font-semibold text-red-300"
                >
                  <i
                    class="fab fa-whatsapp text-white bg-red-500 p-1 rounded-full shadow-md text-xs sm:text-sm"
                  ></i>
                  Whatsapp
                </h2>
                <a
                  href="https://wa.me/628812658192"
                  class="pl-6 sm:pl-8 mt-1 block text-red-300 hover:text-red-100 transition-colors duration-200 text-xs sm:text-sm"
                  >+62 881-2658-192</a
                >
              </div>

              <div>
                <h2
                  class="flex items-center gap-2 text-base sm:text-lg font-semibold text-red-300"
                >
                  <i
                    class="fas fa-phone text-white bg-red-500 p-1 rounded-full shadow-md text-xs sm:text-sm"
                  ></i>
                  Telepon
                </h2>
                <a
                  href="tel:+62744469024"
                  class="pl-6 sm:pl-8 mt-1 block text-red-300 hover:text-red-100 transition-colors duration-200 text-xs sm:text-sm"
                  >(0274) 4469024</a
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