<template><footer class="bg-red-950 text-white pt-12 pb-6 relative overflow-hidden">
  <!-- Garis putih animasi -->
  <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-white via-red-300 to-white animate-pulse"></div>

  <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10 relative z-10">
    <!-- Identitas Sekolah -->
    <div>
      <h2 class="text-2xl font-bold tracking-wide text-white">Sekolah <span class="text-white/70">Lorem Ipsum</span></h2>
      <p class="mt-3 text-sm text-white/80 leading-relaxed">
        Membentuk pelajar tangguh dengan visi masa depan, teknologi, dan semangat nasionalisme.
      </p>
    </div>

    <!-- Navigasi -->
    <div>
      <h3 class="text-sm text-white/70 uppercase tracking-widest font-semibold mb-3">Menu</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="/" class="hover:text-white transition duration-300">Beranda</a></li>
        <li><a href="/artikel" class="hover:text-white transition duration-300">Artikel</a></li>
        <li><a href="/ekstrakurikuler" class="hover:text-white transition duration-300">Ekstrakurikuler</a></li>
        <li><a href="/kontak" class="hover:text-white transition duration-300">Kontak</a></li>
      </ul>
    </div>

    <!-- Kontak -->
    <div>
      <h3 class="text-sm text-white/70 uppercase tracking-widest font-semibold mb-3">Hubungi Kami</h3>
      <p class="text-sm text-white/80">
        Jl. Inovasi No. 88, Cyber City<br>
        Email: info@loremipsum.sch.id<br>
        Telp: (021) 987-6543
      </p>
    </div>
  </div>

  <!-- Garis Bawah -->
  <div class="mt-10 border-t border-white/20 pt-4 px-6 text-sm text-white/60 flex flex-col md:flex-row items-center justify-between">
    <span>© 2025 Sekolah Lorem Ipsum. Semua Hak Dilindungi.</span>
    <div class="flex space-x-4 mt-2 md:mt-0">
      <a href="instagram.com/rifqifauu" class="hover:text-white transition">Instagram</a>
      <a href="#" class="hover:text-white transition">YouTube</a>
      <a href="linkedin.com/ln/rifqifauu" class="hover:text-white transition">LinkedIn</a>
    </div>
  </div>
</footer>

  </template>
  <script>
 export default {
    name: 'Footer'
}
</script>