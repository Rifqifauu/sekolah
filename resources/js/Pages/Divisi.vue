<template>
  <h3 class="text-center text-2xl md:text-3xl lg:text-3xl font-bold mt-5 text-red-600 mb-6">Daftar Divisi Magang</h3>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2 p-8">
    <div 
      v-for="(item, index) in divisi" 
      :key="index" 
      class="bg-red-700 text-white p-6 rounded-lg shadow-lg cursor-pointer hover:bg-red-800 max-h-72"
    >
      <h4 class="text-xl font-bold mb-2">{{ item.nama_divisi }}</h4>
      <p class="mb-2 text-sm">{{ item.keterangan }}</p>
      <p class="mb-4 text-sm font-semibold text-yellow-300">Kuota: {{ item.kuota }}</p>
      <button 
        @click="daftarMagang(item)" 
        class="p-3 rounded w-40 bg-yellow-500 hover:bg-yellow-600 text-black text-sm"
      >
        Daftar
      </button>
    </div>
  </div>
</template>


<script>
import AppLayout from '../layouts/AppLayout.vue';


export default {
  computed: {
},
mounted (){
  document.title = this.title;

},

  props: {
    title: String,
    divisi: {
      type: Array,
      required: true,
      validator(value) {
        return Array.isArray(value) && value.every(item => item.nama_divisi && item.keterangan && item.kuota);
      },
    },
  },
  layout: AppLayout,
  data() {
    return {
    };
  },
  methods: {
daftarMagang(){
  window.location.href="/permohonan/create"
}
  },
};

</script>

<style scoped>
.cursor-pointer:hover {
  transform: translateY(-5px);
  transition: transform 0.3s ease-in-out;
}
</style>