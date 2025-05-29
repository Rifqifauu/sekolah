<template>
    <div class="h-screen flex">
      <!-- Left side with illustration -->
      <div
        class="w-1/2 bg-red-700 p-14 hidden md:block relative bg-gradient-to-l from-red-700 to-red-800"
        style="border-top-right-radius: 2rem; border-bottom-right-radius: 2rem;"
      >
        <h1 class="text-4xl font-bold text-white mb-4">
          Ayo Mulai Magang Sekarang!
        </h1>
        <p class="text-lg text-white mb-10">
          Daftarkan akun Anda untuk mendaftar magang dan mengakses semua fitur.
        </p>
        <img src="../../../storage/asset/Element/undraw_post_eok2.svg" alt="Illustration" class="w-100" />
      </div>
  
      <!-- Right side with registration form -->
      
      <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">

        <a href="/login" class="flex items-center text-red-700 hover:text-red-800 mb-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
    Kembali ke halaman Masuk
  </a>

        <div class="max-w-md w-full mx-auto">
          <h2 class="text-3xl font-bold mb-4 text-red-700">Daftar</h2>
          <p class="text-gray-600 mb-6">
            Silakan isi formulir di bawah ini untuk membuat akun baru.
          </p>
  
          <form @submit.prevent="handleRegister">
            <div class="space-y-4">
              <!-- Name -->
              <div>
                <input
                  type="text"
                  v-model="form.name"
                  placeholder="Masukkan Nama Lengkap Anda"
                  class="w-full px-4 py-3 rounded-full border border-gray-300 focus:ring-2 focus:ring-red-700 focus:border-red-700"
                />
                <p v-if="errors.name" class="text-red-500 text-sm mt-1">
                  {{ errors.name }}
                </p>
              </div>
  
              <!-- Email -->
              <div>
                <input
                  type="email"
                  v-model="form.email"
                  placeholder="Masukkan Email Anda"
                  class="w-full px-4 py-3 rounded-full border border-gray-300 focus:ring-2 focus:ring-red-700 focus:border-red-700"
                />
                <p v-if="errors.email" class="text-red-500 text-sm mt-1">
                  {{ errors.email }}
                </p>
              </div>
  
              <!-- Password -->
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
                  class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"
                >
                  👁
                </button>
                <p v-if="errors.password" class="text-red-500 text-sm mt-1">
                  {{ errors.password }}
                </p>
              </div>
  
              <!-- Confirm Password -->
              <div class="relative">
                <input
                  :type="showConfirmPassword ? 'text' : 'password'"
                  v-model="form.password_confirmation"
                  placeholder="Konfirmasi Kata Sandi Anda"
                  class="w-full px-4 py-3 rounded-full border border-gray-300 focus:ring-2 focus:ring-red-700 focus:border-red-700"
                />
                <button
                  type="button"
                  @click="showConfirmPassword = !showConfirmPassword"
                  class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"
                >
                  👁
                </button>
              </div>
  
              <!-- Submit Button -->
              <button
                type="submit"
                class="w-full bg-red-700 text-white py-3 rounded-full hover:bg-red-800 transition-colors"
              >
                Daftar
              </button>
            </div>
          </form>
  
          <div class="mt-4 text-center">
            <p class="text-gray-600">
              Sudah Punya Akun?
              <a href="/login" class="text-red-700 hover:underline">Masuk Sekarang</a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <ErrorModal 
      :show="showErrorModal"
      :message="errorMessage"
      title="Pendaftaran Akun Gagal"
    />
    
    <SuccessModal
      :show="showSuccessModal"
      title="Pendaftaran Akun Berhasil"
    />
   
  </template>
  
  <script>
  import { ref } from "vue";
  import axios from "axios";
import ErrorModal from '@/components/ErrorModal.vue'
import SuccessModal from '@/components/SuccessModal.vue'
  export default {
    components: {
    ErrorModal,
    SuccessModal
  },
    setup() {
      const form = ref({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      });
  
      const errors = ref({});
      const showPassword = ref(false);
      const showConfirmPassword = ref(false);
      const showErrorModal = ref(false);
      const errorMessage = ref('');
      const showSuccessModal = ref(false);
      const successMessage = ref('Pendaftaran Akun Anda Berhasil');


      const handleRegister = async () => {
  try {
    console.log('Register attempted with:', form.value);

    // Menggunakan axios untuk POST request
    const response = await axios.post('/register', form.value);
    console.log('Register successful:', response.data);

    // Jika register berhasil, tampilkan modal sukses
    showSuccessModal.value = true;
    showErrorModal.value = false;
    setTimeout(() => {
      // Redirect after success
      document.location.href = '/home';
    }, 2000);

  } catch (error) {
    if (error.response) {
      const errors = error.response.data.errors || {}; // Ambil errors jika ada
      if (Object.keys(errors).length > 0) {
        console.error('Validation errors:', errors);
        let errorMessages = '';
        for (let field in errors) {
          if (errors.hasOwnProperty(field)) {
            errorMessages += `${errors[field][0]}  `; 
          }
        }
        errorMessage.value = errorMessages; 
        showErrorModal.value = true; 
        setTimeout(() => {
          showErrorModal.value = false;
        }, 2000);
      } else {
        const messages = error.response.data.messages || [];
        if (messages.length > 0) {
          console.error('Error messages:', messages);
          errorMessage.value = messages.join(', '); // Gabungkan pesan-pesan error
          showErrorModal.value = true;
          setTimeout(() => {
            showErrorModal.value = false;
          }, 2000);
        }
      }
    } else {
      console.error('An unexpected error occurred:', error);
      errorMessage.value = 'An unexpected error occurred. Please try again later.';
      showErrorModal.value = true;
      setTimeout(() => {
        showErrorModal.value = false;
      }, 2000);
    }
  }
};


      return {
        form,
        errors,
        showPassword,
        showConfirmPassword,
        handleRegister,
        showErrorModal,
        errorMessage,
        showSuccessModal,
        successMessage,
      };
    },
  };
  </script>
  
  <style scoped>

  </style>
  