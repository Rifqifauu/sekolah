<template>
    <div class="min-h-screen bg-gray-50 py-8 px-4">
      <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden">
        <!-- Form Header -->
        <div class="bg-red-600 text-white flex justify-between items-center p-4 rounded-2xl">
          <h2 class="text-lg font-semibold">{{ isEdit ? 'Edit Profile' : 'Create Profile' }}</h2>
          <button 
            @click="handleSubmit"
            class="flex items-center bg-white text-red-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ isEdit ? 'Simpan' : 'Buat' }}
          </button>
        </div>
  
        <form @submit.prevent="handleSubmit" class="md:flex">
          <!-- Sidebar -->
          <aside class="md:w-2/5 p-6 bg-gray-50">
            <!-- Profile Photo -->
            <div class="text-center mb-6">
              <div class="w-40 h-50 mx-auto rounded overflow-hidden border-4 border-white shadow-lg relative group">
                <img
                  v-if="preview || formData.foto"
                  :src="preview || `/storage/${formData.foto}`"
                  :alt="formData.name"
                  class="w-full h-full object-cover"
                />
                <div v-else class="w-full h-full p-8 bg-gray-200 flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                  <label class="cursor-pointer bg-white text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-100">
                    <input 
                      type="file" 
                      class="hidden" 
                      accept="image/*"
                      @change="handleImageChange"
                    >
                    Ganti Foto
                  </label>
                </div>
              </div>
              
              <!-- Basic Info -->
              <div class="mt-4 text-left space-y-4">
                
                <FormInput
                  v-model="formData.name"
                  label="Nama Lengkap"
                  placeholder="Masukkan nama lengkap"
                />
                <FormInput
                  v-model="formData.panggilan"
                  label="Nama Panggilan"
                  placeholder="Masukkan nama panggilan"
                />
                
              </div>
            </div>
  
            <!-- Contact Info -->
            <div class="space-y-4">
              <h2 class="text-xl font-semibold text-red-600">Kontak</h2>
              <FormInput
                v-model="formData.nomor_hp"
                type="tel"
                label="Nomor HP"
                placeholder="Masukkan nomor HP"
              />
              <FormInput
                v-model="formData.medsos"
                label="Media Sosial"
                placeholder="Link media sosial"
              />
            </div>
            <h2 class="text-md mt-4 font-semibold text-red-600">Status Pendaftaran</h2>
            <input
                  :value="formData.status_pendaftaran"
                   disabled
                />
                <div class=" space-y-4 mt-4">
                  <a  v-if="formData.status_pendaftaran == 'diterima'" 
  :href="'view/sk_diterima' "  target="_blank"
  class="inline-flex text-sm items-center gap-2 px-2 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md transition-all duration-300 hover:bg-blue-700 hover:-translate-y-1 active:translate-y-0"
>
  Surat Keterangan Diterima
</a>
                  <a target="_blank"  v-if="formData.status_pendaftaran == 'diterima'" 
  :href="'view/surat-pernyataan/'" 
  class="inline-flex text-sm items-center gap-2 px-2 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md transition-all duration-300 hover:bg-blue-700 hover:-translate-y-1 active:translate-y-0"
>
   Surat Kesanggupan
</a>
              <a  v-if="formData.status_pendaftaran == 'selesai'"
  :href="'view/sk_selesai' " 
  class="inline-flex text-sm items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md transition-all duration-300 hover:bg-blue-700 hover:-translate-y-1 active:translate-y-0"
>
  Surat Keterangan Selesai Magang
</a>
            </div>
          </aside>
          <ErrorModal 
      :show="showErrorModal"
      :message="errorMessage"
      title="Gagal Memperbarui Profil"
    />
    
    <SuccessModal
      :show="showSuccessModal"
      title="Berhasil Memperbarui Profil"
    />
          <!-- Main Content -->
          <main class="md:w-3/5 p-6">
            <h2 class="text-2xl font-semibold text-red-600 mb-4">Biodata</h2>
            <div class="space-y-4">
              <FormInput
                v-model="formData.nim"
                label="NIM/NIS/NIP"
                placeholder="Masukkan Nomor Induk Institusi"
                required
              />
              <FormInput
                v-model="formData.nik"
                label="NIK"
                placeholder="Masukkan NIK"
                required
              />
              <FormInput
                v-model="formData.agama"
                label="Agama"
                placeholder="Masukkan Agama"
                required
              />
              <FormInput
                v-model="formData.program_studi"
                label="Program Studi"
                placeholder="Masukkan program studi"
                required
              />
              <FormInput
                v-model="formData.institusi"
                label="Institusi/PT"
                placeholder="Masukkan institusi/PT"
                required
              />

              <FormTextarea
                v-model="formData.alamat"
                label="Alamat (KTP)"
                placeholder="Masukkan alamat lengkap"
                rows="3"
              />
              <FormTextarea
                v-model="formData.domisili"
                label="Domisili"
                placeholder="Masukkan domisili selama magang"
                rows="3"
              />
              <FormSelect
                v-model="formData.jenis_kelamin"
                label="Jenis Kelamin"
                :options="[
                  { value: 'Laki-laki', label: 'Laki-laki' },
                  { value: 'Perempuan', label: 'Perempuan' }
                ]"
                required
              />
            </div>
            
          </main>
        </form>
        
      </div>
  </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { defineComponent, ref, computed } from 'vue';
  import { router } from '@inertiajs/vue3'; // Update this import
  import AppLayout from '@/Layouts/AppLayout.vue';
  import ErrorModal from '@/components/ErrorModal.vue'
import SuccessModal from '@/components/SuccessModal.vue'
  
  // Form Input Component
  const FormInput = defineComponent({
    props: {
      modelValue: String,
      label: String,
      type: {
        type: String,
        default: 'text',
      },
      placeholder: String,
      required: Boolean,
    },
    emits: ['update:modelValue'],
    template: `
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
          {{ label }}
          <span v-if="required" class="text-red-500">*</span>
        </label>
        <input
          :type="type"
          :value="modelValue"
          @input="$emit('update:modelValue', $event.target.value)"
          :placeholder="placeholder"
          :required="required"
          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
        >
      </div>
    `,
  });
  
  
  // Form Textarea Component
  const FormTextarea = defineComponent({
    props: {
      modelValue: String,
      label: String,
      placeholder: String,
      rows: {
        type: [Number, String],
        default: 3,
      },
    },
    emits: ['update:modelValue'],
    template: `
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
          {{ label }}
        </label>
        <textarea
          :value="modelValue"
          @input="$emit('update:modelValue', $event.target.value)"
          :placeholder="placeholder"
          :rows="rows"
          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
        ></textarea>
      </div>
    `,
  });
  
  // Form Select Component
  const FormSelect = defineComponent({
    props: {
      modelValue: String,
      label: String,
      options: Array,
      required: Boolean,
    },
    emits: ['update:modelValue'],
    template: `
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
          {{ label }}
          <span v-if="required" class="text-red-500">*</span>
        </label>
        <select
          :value="modelValue"
          @input="$emit('update:modelValue', $event.target.value)"
          :required="required"
          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
        >
          <option value="">Pilih {{ label }}</option>
          <option 
            v-for="option in options" 
            :key="option.value"
            :value="option.value"
          >
            {{ option.label }}
          </option>
        </select>
      </div>
    `,
  });
  
  export default {
    
    name: 'EditProfile',
    layout: AppLayout,
    components: {
      FormInput,
      FormTextarea,
      FormSelect,
      ErrorModal,
      SuccessModal
    },
  
    props: {
      user: {
        type: Object,
        required: true,
      },
      userDetail: {
        type: Object,
        required: true,
      },
      title : String,
      success: String,
      error: String,
    },
    
    mounted(){
      document.title = this.title;
  },
  
    setup(props) {
      console.log('Props di setup:', props);
     
  // Mendapatkan akses ke $inertia
  const formData = ref({
  ...props.userDetail, 
  name: props.user.name // Menambahkan user.name secara eksplisit
});
      const errorMessage = ref('');

   const showSuccessModal = ref(false);
const showErrorModal = ref(false);

  
  
     
      const preview = ref(null);
  
      const handleImageChange = (event) => {
        const file = event.target.files[0];
        if (file) {
          preview.value = URL.createObjectURL(file);
          formData.value.foto = file;
        }
      };
      
      const isEdit = computed(() => {
        return props.userDetail !== null && props.userDetail !== undefined;
      });
  
    const handleSubmit = async () => {
    try {
      const form = new FormData();
  
      // Menambahkan data ke FormData
      Object.entries(formData.value).forEach(([key, value]) => {
        if (value !== null && value !== undefined) {
          // Jika foto, pastikan ini adalah objek file
          if (key === 'foto' && value instanceof File) {
            form.append(key, value);  // Menambahkan file
          } else {
            form.append(key, value);  // Menambahkan nilai lainnya
          }
        }
      });
  
      // Tambahkan _method untuk spoofing method PUT
      if (props.userDetail) {
        form.append('_method', 'PUT'); // Only append _method for PUT if editing
      }
  
      // Debug: Periksa FormData menggunakan forEach
      form.forEach((value, key) => {
        console.log('Isi Form', `Key: ${key}, Value: ${value}`);
      });
  
      // Choose the endpoint based on whether the profile is being created or edited
      const endpoint = props.userDetail ? '/profile/edit' : '/profile/store';
      const response = await axios.post(endpoint, form);
  
      console.log(response.data);  
  
      if (response.status === 200) {
        showSuccessModal.value = true;
        setTimeout(() => {
        showSuccessModal.value=false;
      }, 2000);
      }
    } catch (error) {
      if (error.response && error.response.data.errors) {
      console.error('Error updating profile:', error);
      errorMessage.value = error.response.data.errors; 
      showErrorModal.value = true; // Tampilkan modal error
      setTimeout(() => {
        showErrorModal.value = false;
      }, 2000);
      } else {
            console.error('An unexpected error occurred:', error.response.data.messages)
            for (let key in error.response.data.messages) {
            if (error.response.data.messages.hasOwnProperty(key)) {
              // Menampilkan setiap pesan error untuk masing-masing field
              console.log(`Error in ${key}:`, error.response.data.messages[key][0]);
              errorMessage.value = error.response.data.messages[key][0];
              showErrorModal.value = true; // Tampilkan modal error
      setTimeout(() => {
        showErrorModal.value = false;
      }, 2000);
            }
          }
        }
    }
  };
  
      return {
        showSuccessModal, 
        formData,
        preview,
        handleImageChange,
        handleSubmit,
        isEdit,
        showErrorModal,
        errorMessage,
      };
    },
  };
  </script>