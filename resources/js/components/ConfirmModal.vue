<template>
    <div class="fixed inset-0 z-40 min-h-full overflow-y-auto overflow-x-hidden transition flex items-center">
      <!-- Overlay -->
      <div aria-hidden="true" class="fixed inset-0 w-full h-full bg-black/50 cursor-pointer"></div>
      <!-- Modal -->
      <div class="relative w-full cursor-pointer pointer-events-none transition my-auto p-4">
        <div class="w-full py-2 bg-white cursor-default pointer-events-auto dark:bg-gray-800 relative rounded-xl mx-auto max-w-sm">        
  
          <!-- Content -->
          <div class="space-y-2 p-2">
            <div class="p-4 space-y-2 text-center dark:text-white">
              <h2 class="text-xl font-bold tracking-tight">
                {{ title }}
              </h2>
              <p class="text-gray-500">{{ message }}</p>
            </div>
          </div>
  
          <!-- Actions -->
          <div class="space-y-2">
            <div aria-hidden="true" class="border-t dark:border-gray-700 px-2"></div>
  
            <div class="px-6 py-2">
              <div class="grid gap-2 grid-cols-2">
                <button @click="$emit('close')" type="button"
                  class="inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-gray-800 bg-white border-gray-300 hover:bg-gray-50">
                  Batal
                </button>
  
                <button @click="$emit('confirm')" type="submit"
                  class="inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow bg-red-600 hover:bg-red-500 focus:bg-red-700">
                  Konfirmasi
                </button>
              </div>
            </div>
          </div>
  
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ConfirmModal',
    props: {
      title: {
        type: String,
        required: true
      },
      message: {
        type: String,
        required: true
      }
    }
  };
  </script>  