<template>
  <div class="flex flex-col md:flex-row">
    <!-- Left side with illustration, hidden on mobile -->
    <div 
      class="w-full md:w-1/2 bg-red-700 p-8 md:p-14 relative hidden md:block inset-0 bg-gradient-to-l from-red-700 to-red-800 transition-opacity duration-500 ease-in-out" 
      style="border-top-right-radius: 2rem; border-bottom-right-radius: 2rem;" 
      data-aos="fade-right" 
      data-aos-duration="1000">
      <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
        Ayo Mulai Magang Sekarang!
      </h1>
      <p class="text-base md:text-lg text-white mb-6">Anda Perlu Masuk untuk mendaftar magang dan mengakses semua fitur</p>
      <div class="relative">
        <img
          src="/storage/login.svg"
          alt="Person standing in front of door"
          class="w-64 md:w-full mx-auto"
        />
      </div>
    </div>

    <!-- Right side with login form -->
    <div class="w-full md:w-1/2 p-8 flex flex-col justify-center" data-aos="fade-left" data-aos-duration="1000">
  <div class="flex justify-between items-center mb-6">
    <!-- Tombol Kembali -->
    <a href="/home" class="flex items-center text-red-700 hover:text-red-800">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Kembali ke Beranda
    </a>

    <!-- Logo di Sebelah Kanan -->
    <img
      src="/storage/bayanpus.svg"
      alt="Balai Yanpus DPAD DIY"
      class="h-6 md:h-8 lg:h-8"
    />
  </div>

  <div class="max-w-md w-full mx-auto">
    <h2 class="text-3xl font-bold mb-4 text-red-700">Masuk</h2>
    <p class="text-gray-600 mb-6">
      Silakan masukkan alamat email dan kata sandi sesuai dengan data saat pendaftaran.
    </p>

    <form @submit.prevent="handleLogin">
      <div class="space-y-4">
        <div>
          <input
            type="email"
            v-model="form.email"
            placeholder="Masukkan Email Anda"
            class="w-full px-4 py-3 rounded-full border border-gray-300 focus:ring-2 focus:ring-red-700 focus:border-red-700"
          />
        </div>

        <div class="relative">
          <input
            :type="showPassword ? 'text' : 'password'"
            v-model="form.password"
            placeholder="Masukkan Kata Sandi Anda"
            class="w-full px-4 py-3 rounded-full border border-gray-300 focus:ring-2 focus:ring-red-700 focus:border-red-700"
          />
          <button
            type="button"
            @click="showPassword = !showPassword"
            class="absolute right-4 top-1/2 transform -translate-y-1/2"
          >
            <i class="text-gray-400">👁</i>
          </button>
        </div>

        <div class="flex items-center">
          <input
            type="checkbox"
            v-model="form.remember"
            id="remember"
            class="rounded border-gray-300 text-red-700 focus:ring-red-700"
          />
          <label for="remember" class="ml-2 text-gray-600">
            Ingat Saya
          </label>
        </div>

        <button
          type="submit"
          class="w-full bg-red-700 text-white py-3 rounded-full hover:bg-red-800 transition-colors"
        >
          Masuk
        </button>
      </div>
    </form>

    <div class="mt-4 text-center space-y-2">
      <p class="text-gray-600">
        Belum Punya Akun? 
        <a href="/register" class="text-red-700 hover:underline">Daftar Sekarang</a>
      </p>
    </div>
  </div>
</div>

    <ErrorModal 
      :show="showErrorModal"
      :message="errorMessage"
      :title="titleMessage"
    />
    
    <SuccessModal
      :show="showSuccessModal"
      :title="titleMessage"
    />
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import AOS from 'aos'
import axios from 'axios'
import 'aos/dist/aos.css'
import ErrorModal from '@/components/ErrorModal.vue'
import SuccessModal from '@/components/SuccessModal.vue'

export default {
  components: {
    ErrorModal,
    SuccessModal
  },
  
  setup() {
    const form = ref({
      email: '',
      password: '',
      remember: false
    });
    const showPassword = ref(false);
    const showErrorModal = ref(false);
    const errorMessage = ref('');
    const titleMessage = ref('');
    const showSuccessModal = ref(false);
    
    const handleLogin = async () => {
      try {
        console.log('Login attempted with:', form.value);
        const response = await axios.post('/login', form.value);
        console.log('Login successful:', response.data);
        showSuccessModal.value = true;
        showErrorModal.value = false;
        titleMessage.value = 'Login Berhasil';
        setTimeout(() => {
          document.location.href = '/home';
        }, 2000);
      } catch (error) {
        if (error.response && error.response.data.errors) {
          errorMessage.value = error.response.data.errors.email[0];
          titleMessage.value = 'Login Gagal';
          showErrorModal.value = true;
          setTimeout(() => {
            showErrorModal.value = false;
          }, 2000);
        } else {
          errorMessage.value = 'Terjadi kesalahan tak terduga. Silakan coba lagi nanti.';
          showErrorModal.value = true;
          setTimeout(() => {
            showErrorModal.value = false;
          }, 2000);
        }
      }
    };

    onMounted(() => {
      AOS.init();
      document.title = "Login";
    });

    return {
      form,
      showPassword,
      showErrorModal,
      showSuccessModal,
      errorMessage,
      handleLogin, 
      titleMessage
    };
  }
};
</script>