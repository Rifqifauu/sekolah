<script setup>
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

// Definisi props yang benar
defineProps({
  user: Object
})

defineOptions({
  layout: AppLayout
})
</script>

<template>
  <Head title="404 Not Found" />
  <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">
            <!-- Hapus img jika tidak digunakan -->
            <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-red-600 dark:text-red-500">404</h1>
            <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">
                Halaman Tidak Ditemukan.
            </p>
           <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">
  Mohon maaf <span class="text-red-600">{{ user ? user.name : 'pengunjung' }}</span>, sepertinya kamu tersesat.
</p>

        </div>   
    </div>
  </section>
</template>
