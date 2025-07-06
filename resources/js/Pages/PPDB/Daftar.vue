<template>
  <AppLayout>
    <div class="max-w-4xl mx-auto py-12 px-6" data-aos="fade-up" data-aos-duration="1000">
      <h1 class="text-3xl font-bold text-center text-red-800 mb-10" data-aos="fade-down">
        Formulir Pendaftaran Peserta Didik Baru
      </h1>

      <form
        @submit.prevent="submitForm"
        class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-8 shadow-xl rounded-xl"
        data-aos="zoom-in"
        data-aos-duration="800"
      >
        <div>
          <label class="block mb-1 font-semibold text-gray-700">Nama Lengkap</label>
          <input type="text" v-model="form.nama" class="w-full p-3 border rounded" required />
        </div>

        <div>
          <label class="block mb-1 font-semibold text-gray-700">Email</label>
          <input type="email" v-model="form.email" class="w-full p-3 border rounded" required />
        </div>

        <div class="md:col-span-2">
          <label class="block mb-1 font-semibold text-gray-700">Alamat</label>
          <input type="text" v-model="form.alamat" class="w-full p-3 border rounded" required />
        </div>

        <div>
          <label class="block mb-1 font-semibold text-gray-700">Jenis Kelamin</label>
          <select v-model="form.jenis_kelamin" class="w-full p-3 border rounded" required>
            <option value="" disabled>Pilih</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>

        <div>
          <label class="block mb-1 font-semibold text-gray-700">Tanggal Lahir</label>
          <input type="date" v-model="form.tanggal_lahir" class="w-full p-3 border rounded" required />
        </div>

        <div>
          <label class="block mb-1 font-semibold text-gray-700">Asal Sekolah</label>
          <input type="text" v-model="form.asal_sekolah" class="w-full p-3 border rounded" required />
        </div>
        <div>
          <label class="block mb-1 font-semibold text-gray-700">NISN</label>
          <input type="text" v-model="form.nisn" class="w-full p-3 border rounded" required />
        </div>

        <div>
          <label class="block mb-1 font-semibold text-gray-700">Nama Orang Tua</label>
          <input type="text" v-model="form.nama_ortu" class="w-full p-3 border rounded" required />
        </div>

        <div>
          <label class="block mb-1 font-semibold text-gray-700">No. HP Orang Tua</label>
          <input type="text" v-model="form.hp_ortu" class="w-full p-3 border rounded" required />
        </div>

        <div class="md:col-span-2">
          <label class="block mb-1 font-semibold text-gray-700">Upload Dokumen (PDF)</label>
          <input
            type="file"
            @change="handleFileUpload"
            accept="application/pdf"
            class="w-full p-3 border rounded bg-white"
            required
          />
          <p class="text-sm text-gray-500 mt-1">Gabungan Akta, KK, dan Rapor dalam satu file PDF.</p>
        </div>

        <div class="md:col-span-2 text-center mt-6" data-aos="fade-up" data-aos-duration="800">
          <button
            type="submit"
            class="w-full bg-red-800 hover:bg-red-700 text-white text-lg font-semibold px-6 py-3 rounded-full shadow-md transition"
          >
            📄 Kirim Pendaftaran
          </button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '../../layouts/AppLayout.vue'
import { ref, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import AOS from 'aos'
import 'aos/dist/aos.css'

const form = ref({
  nama: '',
  email: '',
  alamat: '',
  jenis_kelamin: '',
  tanggal_lahir: '',
  asal_sekolah: '',
  nisn: '',
  nama_ortu: '',
  hp_ortu: '',
  dokumen: null,
})

function handleFileUpload(e) {
  const file = e.target.files[0]
  if (file && file.type === 'application/pdf') {
    form.value.dokumen = file
  } else {
    alert('Mohon unggah file PDF.')
    e.target.value = null
  }
}

function resetForm() {
  form.value = {
    nama: '',
    email: '',
    alamat: '',
    jenis_kelamin: '',
    tanggal_lahir: '',
    asal_sekolah: '',
    nisn: '',
    nama_ortu: '',
    hp_ortu: '',
    dokumen: null,
  }
}

function submitForm() {
  const formData = new FormData()
  for (const key in form.value) {
    formData.append(key, form.value[key])
  }

  router.post('/ppdb', formData, {
    forceFormData: true,
    onSuccess: () => {
      alert('✅ Pendaftaran berhasil!')
      resetForm()
    },
    onError: (errors) => {
      console.error(errors)
      alert('❌ Gagal mengirim data. Periksa input Anda.')
    },
  })
}

onMounted(() => {
  AOS.init({
    once: true,
    duration: 1000,
  })
})
</script>
