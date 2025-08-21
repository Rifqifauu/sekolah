<template>
  <div class="p-6 max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Buku</h1>

    <!-- Form Pencarian -->
    <div class="mb-6">
      <form @submit.prevent="searchBooks" class="flex items-center gap-2">
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Cari berdasarkan judul atau pengarang..."
          class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <button
          type="submit"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200"
        >
          <i class="fas fa-search"></i>
        </button>
        <button
          type="button"
          @click="resetSearch"
          class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition duration-200"
        >
          <i class="fas fa-sync-alt"></i>
        </button>
      </form>
    </div>

    <!-- Modal Peminjaman -->
    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
        <h2 class="text-lg font-semibold mb-4">Scan Kartu Anggota</h2>

        <!-- Log Area untuk Peminjaman -->
        <div v-if="logText" class="mb-4 p-3 rounded-md text-sm" :class="logStatus === 'success' ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300'">
          {{ logText }}
        </div>

        <button class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl" @click="closeModal">×</button>

        <form @submit.prevent="submitPinjam" class="flex flex-col gap-2 w-full">
          <input type="hidden" name="buku_id" :value="selectedBookId" />
          <input
            type="text"
            name="anggota_id"
            v-model="nomor_nfc"
            placeholder="Scan atau Masukkan Nomor NFC"
            required
            class="border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            :disabled="isProcessing"
          />
          <div class="flex justify-end">
            <button
              type="submit"
              class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200 disabled:opacity-50"
              :disabled="isProcessing"
            >
              {{ isProcessing ? 'Memproses...' : 'Pinjam' }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Pengembalian -->
    <div v-if="showReturnModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
        <h2 class="text-lg font-semibold mb-4">Masukkan ID Anggota untuk Pengembalian</h2>

        <!-- Log Area untuk Pengembalian -->
        <div v-if="returnLogText" class="mb-4 p-3 rounded-md text-sm" :class="returnLogStatus === 'success' ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300'">
          {{ returnLogText }}
        </div>

        <button class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl" @click="closeReturnModal">×</button>

        <form @submit.prevent="submitKembali" class="flex flex-col gap-2 w-full">
          <input type="hidden" name="buku_id" :value="returnBookId" />
          <input
            type="text"
            name="anggota_id"
            v-model="returnnomor_nfc"
            placeholder="Masukkan Nomor ID"
            required
            class="border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500"
            :disabled="isReturning"
          />
          <div class="flex justify-end">
            <button
              type="submit"
              class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200 disabled:opacity-50"
              :disabled="isReturning"
            >
              {{ isReturning ? 'Memproses...' : 'Kembalikan' }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Daftar Buku -->
    <div class="space-y-6">
      <div
        v-for="buku in props.data_buku.data"
        :key="buku.id"
        class="md:flex items-start border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden rounded-lg"
      >
        <div class="md:w-48 md:h-64 p-2 flex-shrink-0 bg-white">
          <img
            v-if="buku.cover"
            :src="`/storage/${buku.cover}`"
            alt="Cover Buku"
            class="w-full h-full object-cover rounded"
          />
          <div v-else class="w-full h-full flex items-center justify-center text-gray-400 text-xs italic bg-gray-100 rounded">
            No Cover
          </div>
        </div>

        <div class="p-4 flex flex-col justify-between flex-1 space-y-2 bg-white">
          <div>
            <h2 class="text-xl font-semibold text-gray-800">{{ buku.judul_buku }}</h2>
            <p class="text-sm text-gray-500 mb-2">oleh {{ buku.pengarang }}</p>

            <div class="grid grid-cols-2 gap-2 text-sm text-gray-600">
              <p><strong>Penerbit:</strong> {{ buku.penerbit ?? '-' }}</p>
              <p><strong>Tahun:</strong> {{ buku.tahun_terbit ?? '-' }}</p>
              <p><strong>ISBN:</strong> {{ buku.isbn ?? '-' }}</p>
              <p><strong>Kategori:</strong> {{ buku.kategori ?? '-' }}</p>
            </div>
          </div>

          <div class="flex flex-wrap gap-2 pt-2 items-center">
            <span
              class="inline-block px-3 py-1 text-xs font-semibold rounded-full"
              :class="{
                'bg-green-100 text-green-800': buku.status === 'tersedia',
                'bg-red-100 text-red-800': buku.status === 'kosong',
              }"
            >
              {{ buku.status }}
            </span>
            <span
              class="inline-block px-3 py-1 text-xs font-semibold rounded-full"
              :class="{
                'bg-green-100 text-green-800': buku.status === 'tersedia',
                'bg-red-100 text-red-800': buku.status === 'kosong',
              }"
            >
             {{ buku.jumlah - buku.dipinjam }}
            </span>
          </div>

          <div class="grid md:grid-cols-4 gap-2 pt-4" v-if="props.auth.user?.role== 'pustakawan'">
            <button
              class="text-sm bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 disabled:opacity-50"
              :disabled="buku.status === 'kosong'"
              @click="openModal(buku.id)"
            >
              Pinjam Buku
            </button>

            <button
              class="text-sm bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200"
              @click="openReturnModal(buku.id)"
            >
              Kembalikan Buku
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-8 flex-wrap gap-2">
      <button
        v-for="(link, index) in props.data_buku.links"
        :key="index"
        v-if="link && link.url"
        @click="goTo(link.url)"
        v-html="link.label"
        class="px-3 py-2 border rounded transition duration-200"
        :class="{
          'bg-blue-600 text-white font-bold': link.active,
          'hover:bg-gray-100': !link.active
        }"
      />
    </div>
  </div>
</template>

<script setup>
import AppLayout from '../../layouts/AppLayout.vue'
import { defineProps, ref } from 'vue'
import { router } from '@inertiajs/vue3'

defineOptions({ layout: AppLayout })

const props = defineProps({
  data_buku: Object,
  query: {
    type: String,
    default: '',
  },
  auth: {
    type: Object,
    default: () => ({ user: null }),
  },
})

// === Pencarian ===
const searchQuery = ref(props.query)

function searchBooks() {
  if (searchQuery.value.trim()) {
    router.get('/perpustakaan/search', {
      query: searchQuery.value,
    }, {
      preserveScroll: true,
      preserveState: true,
    })
  }
}

function resetSearch() {
  searchQuery.value = ''
  router.get('/perpustakaan')
}

// === Peminjaman ===
const showModal = ref(false)
const logText = ref('')
const logStatus = ref('')
const selectedBookId = ref(null)
const nomor_nfc = ref('')
const isProcessing = ref(false)


function openModal(bookId) {
  selectedBookId.value = bookId
  nomor_nfc.value = ''
  logText.value = ''
  logStatus.value = ''
  showModal.value = true
}

function closeModal() {
  showModal.value = false
  selectedBookId.value = null
  logText.value = ''
  logStatus.value = ''
  isProcessing.value = false
}

function submitPinjam() {
  if (isProcessing.value) return

  isProcessing.value = true
  logText.value = 'Memproses peminjaman...'
  logStatus.value = 'info'

  router.post('/pinjam-buku', {
    id_buku: selectedBookId.value,
    nomor_nfc: nomor_nfc.value,
  }, {
    onStart: () => {
      logText.value = 'Memproses peminjaman...'
      logStatus.value = 'info'
    },
    onSuccess: () => {
      logText.value = '✅ Berhasil meminjam buku.'
      logStatus.value = 'success'
      setTimeout(() => {
        closeModal()
      }, 1500)
    },
    onError: (errors) => {
      logText.value = '❌ Gagal meminjam buku. Pastikan data valid.'
      if (errors.nomor_nfc) {
        logText.value = `❌ ${errors.nomor_nfc}`
      }
      logStatus.value = 'error'
    },
    onFinish: () => {
      isProcessing.value = false
    }
  })
}

// === Pengembalian ===
const showReturnModal = ref(false)
const returnLogText = ref('')
const returnLogStatus = ref('')
const returnBookId = ref(null)
const returnnomor_nfc = ref('')
const isReturning = ref(false)

function openReturnModal(bookId) {
  returnBookId.value = bookId
  returnnomor_nfc.value = ''
  returnLogText.value = ''
  returnLogStatus.value = ''
  showReturnModal.value = true
}

function closeReturnModal() {
  showReturnModal.value = false
  returnBookId.value = null
  returnLogText.value = ''
  returnLogStatus.value = ''
  isReturning.value = false
}

function submitKembali() {
  if (isReturning.value) return

  isReturning.value = true
  returnLogText.value = 'Memproses pengembalian...'
  returnLogStatus.value = 'info'

  router.post('/kembalikan-buku', {
    id_buku: returnBookId.value,
    nomor_nfc: returnnomor_nfc.value,
  }, {
    onStart: () => {
      returnLogText.value = 'Memproses pengembalian...'
      returnLogStatus.value = 'info'
    },
    onSuccess: () => {
      returnLogText.value = '✅ Buku berhasil dikembalikan.'
      returnLogStatus.value = 'success'
      setTimeout(() => {
        closeReturnModal()
      }, 1500)
    },
    onError: (errors) => {
      returnLogText.value = '❌ Gagal mengembalikan buku. Pastikan data valid.'
      if (errors.nomor_nfc) {
        returnLogText.value = `❌ ${errors.nomor_nfc}`
      }
      returnLogStatus.value = 'error'
    },
    onFinish: () => {
      isReturning.value = false
    }
  })
}

// === Pagination ===
function goTo(url) {
  router.visit(url, {
    preserveScroll: true,
    preserveState: true,
  })
}

// Set document title
document.title = 'Perpustakaan'
</script>

<style scoped>
/* Custom styles jika diperlukan */
.transition-shadow {
  transition: box-shadow 0.3s ease;
}
</style>
