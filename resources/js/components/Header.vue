<template>
  <header>
    <nav class="fixed top-0 left-0 right-0 z-30 drop-shadow-xl bg-red-900 shadow-md">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo -->
          <div class="flex-shrink-0 p-2">
            <p class="text-white font-bold text-xl">Sekolahku</p>
          </div>

          <!-- Desktop Navigation -->
          <div class="hidden lg:flex lg:items-center lg:space-x-6">
            <a href="/home" class="text-white hover:text-gray-200 px-3 py-2">Beranda</a>

            <!-- Media Dropdown -->
            <div class="relative group">
              <button class="text-white hover:text-gray-200 px-3 py-2 flex items-center">
                Media
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              <div class="absolute left-0 w-full h-3 invisible"></div>
              <div class="absolute left-0 mt-0 min-w-[180px] z-40 bg-red-950/90 text-white rounded shadow-md 
                          opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                          transition-all duration-300">
                <a href="/artikel" class="block px-4 py-2 hover:bg-red-950">Artikel</a>
                <a href="/pengumuman" class="block px-4 py-2 hover:bg-red-950">Pengumuman</a>
                <a href="/galeri" class="block px-4 py-2 hover:bg-red-950">Galeri</a>
              </div>
            </div>

            <!-- Profil Dropdown -->
            <div class="relative group">
              <button class="text-white hover:text-gray-200 px-3 py-2 flex items-center">
                Profil
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              <div class="absolute left-0 w-full h-3 invisible"></div>
              <div class="absolute left-0 mt-0 min-w-[180px] z-40 bg-red-950/90 text-white rounded shadow-md 
                          opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                          transition-all duration-300">
                <a href="/struktur-organisasi" class="block px-4 py-2 hover:bg-red-950">Struktur Organisasi</a>
                <a href="/guru" class="block px-4 py-2 hover:bg-red-950">Data Guru</a>
                <a href="/staff" class="block px-4 py-2 hover:bg-red-950">Data Staff</a>
              </div>
            </div>

            <a href="/kontak" class="text-white hover:text-gray-200 px-3 py-2">Kontak</a>
            <a href="/ekstrakurikuler" class="block text-white px-4 py-2">Ekstrakurikuler</a>
            <a href="/ppdb" class="block text-white px-4 py-2">PPDB</a>

          </div>

          <!-- Search Form -->
          <form @submit.prevent="handleSearch" class="hidden lg:block w-64 relative">
            <input
              v-model="searchQuery"
              type="search"
              placeholder="Cari..."
              class="w-full py-2 pl-10 pr-4 rounded-lg bg-gray-50 text-sm border border-gray-300 focus:ring focus:ring-red-950"
            />
            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-4.35-4.35M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z" />
              </svg>
            </div>
          </form>

          <!-- Mobile Menu Button -->
          <div class="lg:hidden">
            <button @click="toggleMenu" class="text-white hover:text-gray-300">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path v-if="!menuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
                <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
<!-- Mobile Menu -->
<transition name="mobile-menu">
  <div v-if="menuOpen" class="lg:hidden w-full left-0 bg-red-950 text-white shadow-md absolute  overflow-visible z-50">
    <a href="/home" class="block px-4 py-2 hover:bg-red-950">Beranda</a>

    <!-- Media Dropdown -->
    <div class="relative">
      <button @click="toggleMobileDropdown('media')" class="w-full text-left px-4 py-2 hover:bg-red-950 flex justify-between items-center">
        <span>Media</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            :d="openDropdown === 'media' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7'"></path>
        </svg>
      </button>
      <transition name="dropdown">
        <div v-show="openDropdown === 'media'" class="pl-4 bg-red-950">
          <a href="/artikel" class="block px-4 py-2 hover:bg-red-950">Artikel</a>
          <a href="/pengumuman" class="block px-4 py-2 hover:bg-red-950">Pengumuman</a>
          <a href="/galeri" class="block px-4 py-2 hover:bg-red-950">Galeri</a>
        </div>
      </transition>
    </div>

    <!-- Profil Dropdown -->
    <div class="relative">
      <button @click="toggleMobileDropdown('profil')" class="w-full text-left px-4 py-2 hover:bg-red-950 flex justify-between items-center">
        <span>Profil</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            :d="openDropdown === 'profil' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7'"></path>
        </svg>
      </button>
      <transition name="dropdown">
        <div v-show="openDropdown === 'profil'" class="pl-4 bg-red-950">
          <a href="/struktur-organisasi" class="block px-4 py-2 hover:bg-red-950">Struktur Organisasi</a>
          <a href="/guru" class="block px-4 py-2 hover:bg-red-950">Data Guru</a>
          <a href="/staff" class="block px-4 py-2 hover:bg-red-950">Data Staff</a>
        </div>
      </transition>
    </div>

    <a href="/kontak" class="block px-4 py-2 hover:bg-red-950">Kontak</a>
    <a href="/ppdb" class="block px-4 py-2 hover:bg-red-950">PPDB</a>
    
  </div>
</transition>

      </div>
    </nav>

    <!-- Spacer -->
    <div class="h-16"></div>
  </header>
</template>


<script>
import { ref } from 'vue'

export default {
  name: 'Header',
  setup() {
    const menuOpen = ref(false)
    const searchQuery = ref('')
    const openDropdown = ref(null)
function toggleMenu() {
  menuOpen.value = !menuOpen.value
}

function toggleMobileDropdown(name) {
  openDropdown.value = openDropdown.value === name ? null : name
}

function handleSearch() {
  if (searchQuery.value.trim() !== '') {
    // Redirect ke URL pencarian Laravel, misal: /search?q=kata
    window.location.href = `/search?q=${encodeURIComponent(searchQuery.value)}`
  }
}

    return {
      menuOpen,
      searchQuery,
      openDropdown,
      toggleMenu,
      toggleMobileDropdown,
      handleSearch
    }
  }
}
</script>

<style scoped>
.mobile-menu-enter-active,
.mobile-menu-leave-active {
  transition: opacity 0.2s ease, transform 0.2s ease;
}
.mobile-menu-enter-from,
.mobile-menu-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

.dropdown-enter-active,
.dropdown-leave-active {
  transition: max-height 0.3s ease, opacity 0.3s ease;
  max-height: 100px;
  opacity: 1;
  overflow: hidden;
}
.dropdown-enter-from,
.dropdown-leave-to {
  max-height: 0;
  opacity: 0;
  overflow: hidden;
}
</style>