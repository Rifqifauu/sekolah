<template>
    <transition 
      enter-active-class="transition-transform duration-300 ease-out"
      enter-from-class="opacity-0 scale-90"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition-transform duration-300 ease-in"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-90"
    >
      <div v-if="show" class="fixed inset-0 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-80">
          <div class="text-center">
            <h3 class="text-xl font-semibold text-red-700">{{ title }}</h3>
          </div>
          <div class="mt-4 text-center">
            <img src="../../../storage/asset/gagal.gif" alt="Error Illustration" class="mx-auto mb-6 w-40 h-40">
            <p class="text-gray-800">{{ message }}</p>
          </div>
        </div>
      </div>
    </transition>
  </template>
  
  <script>
  export default {
    name: 'ErrorModal',
    props: {
      show: {
        type: Boolean,
        required: true
      },
      title: {
        type: String,
        required: true
      },
      message: {
        type: String,
        required: true
      }
    }
  }
  </script>