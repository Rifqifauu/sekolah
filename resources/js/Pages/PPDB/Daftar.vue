<template>
  <AppLayout>
    <div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100 py-8 px-4">
      <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8" data-aos="fade-down">
          <h1 class="text-4xl font-bold text-green-800 mb-3">
            Formulir Pendaftaran Peserta Didik Baru
          </h1>
          <p class="text-gray-600 text-lg">
            Lengkapi data di bawah ini dengan benar dan lengkap
          </p>
        </div>

        <form
          @submit.prevent="submitForm"
          class="bg-white rounded-2xl shadow-2xl overflow-hidden"
          data-aos="zoom-in"
          data-aos-duration="800"
        >
          <!-- Progress Bar -->
          <div class="bg-green-800 h-2">
            <div class="bg-green-600 h-full transition-all duration-500 ease-in-out" :style="`width: ${progressPercentage}%`"></div>
          </div>

          <div class="p-8 md:p-10">
            <!-- Section 1: Data Siswa -->
           <div class="mb-10 space-y-10">
  <!-- SECTION 1: DATA SISWA -->
  <section>
    <h2 class="text-2xl font-bold text-green-800 mb-6 flex items-center">
      <span class="bg-green-100 text-green-800 rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-3">1</span>
      Data Siswa
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
      <!-- Pilihan Program -->
      <div class="md:col-span-2 xl:col-span-3">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          Pilihan Program <span class="text-green-500">*</span>
        </label>
        <select v-model="form.pilihan_program" class="form-select" required>
          <option value="">Pilih program studi</option>
          <option value="TKJ">TEKNIK JARINGAN KOMPUTER DAN TELEKOMUNIKASI</option>
          <option value="OTOMOTIF">TEKNIK OTOMOTIF</option>
        </select>
      </div>

      <!-- Nama Lengkap -->
      <div class="md:col-span-2 xl:col-span-3">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          Nama Lengkap <span class="text-green-500">*</span>
        </label>
        <input type="text" v-model="form.nama" class="form-input" placeholder="Masukkan nama lengkap sesuai ijazah" required />
      </div>

      <!-- TTL -->
      <div class="">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          Tempat, Tanggal Lahir <span class="text-green-500">*</span>
        </label>
        <input type="text" v-model="form.tempat_tanggal_lahir" class="form-input" placeholder="Contoh: Jakarta, 15 Januari 2010" required />
      </div>

      <!-- Jenis Kelamin -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin <span class="text-green-500">*</span></label>
        <select v-model="form.jenis_kelamin" class="form-select" required>
          <option value="">Pilih jenis kelamin</option>
          <option value="Laki-Laki">Laki-Laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>

      <!-- Agama -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Agama <span class="text-green-500">*</span></label>
        <select v-model="form.agama" class="form-select" required>
          <option value="">Pilih agama</option>
          <option value="Islam">Islam</option>
          <option value="Kristen">Kristen</option>
          <option value="Katolik">Katolik</option>
          <option value="Hindu">Hindu</option>
          <option value="Budha">Budha</option>
          <option value="Konghucu">Konghucu</option>
        </select>
      </div>

      <!-- KIP -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Memiliki KIP? <span class="text-green-500">*</span></label>
        <div class="flex gap-4">
          <label class="flex items-center">
            <input type="radio" :value="true" v-model="form.kip" required class="text-green-500 focus:ring-green-500" />
            <span class="ml-2 text-sm text-gray-700">Ya</span>
          </label>
          <label class="flex items-center">
            <input type="radio" :value="false" v-model="form.kip" required class="text-green-500 focus:ring-green-500" />
            <span class="ml-2 text-sm text-gray-700">Tidak</span>
          </label>
        </div>
      </div>

      <!-- Nomor KIP -->
      <div class="">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor KIP</label>
        <input type="text" v-model="form.nomor_kip" class="form-input" placeholder="Masukkan nomor KIP jika ada" />
      </div>

      <!-- NISN -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">NISN <span class="text-green-500">*</span></label>
        <input type="text" v-model="form.nisn" class="form-input" placeholder="10 digit NISN" maxlength="10" required />
      </div>

      <!-- Asal Sekolah -->
      <div class="md:col-span-2 xl:col-span-3">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Asal Sekolah <span class="text-green-500">*</span></label>
        <input type="text" v-model="form.asal_sekolah" class="form-input" placeholder="Nama sekolah SMP/MTS" required />
      </div>
    </div>
  </section>
<!-- SECTION 2: ALAMAT -->
<section>
  <h3 class="text-xl font-semibold text-green-700 mb-4">Alamat Lengkap</h3>
  <div class="space-y-4">
    <!-- Alamat Murid -->
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Murid <span class="text-green-500">*</span></label>
      <textarea v-model="form.alamat" rows="2" class="form-input w-full" placeholder="Masukkan alamat lengkap murid" required></textarea>
    </div>
    <!-- Alamat Ortu -->
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Ortu <span class="text-green-500">*</span></label>
      <textarea v-model="form.alamat_ortu" rows="2" class="form-input w-full" placeholder="Masukkan alamat lengkap ortu" required></textarea>
    </div>

    <!-- Grid Dua Kolom untuk Provinsi - Desa -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Provinsi <span class="text-green-500">*</span></label>
        <input type="text" v-model="form.provinsi" class="form-input w-full" required />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Kabupaten <span class="text-green-500">*</span></label>
        <input type="text" v-model="form.kabupaten" class="form-input w-full" required />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Kecamatan <span class="text-green-500">*</span></label>
        <input type="text" v-model="form.kecamatan" class="form-input w-full" required />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Desa <span class="text-green-500">*</span></label>
        <input type="text" v-model="form.desa" class="form-input w-full" required />
      </div>
    </div>

    <!-- Grid Tiga Kolom untuk RT RW Kode Pos -->
    <div class="grid grid-cols-3 gap-4">
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">RT <span class="text-green-500">*</span></label>
        <input type="text" v-model="form.rt" class="form-input w-full" placeholder="001" required />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">RW <span class="text-green-500">*</span></label>
        <input type="text" v-model="form.rw" class="form-input w-full" placeholder="005" required />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Pos <span class="text-green-500">*</span></label>
        <input type="text" v-model="form.kode_pos" maxlength="5" class="form-input w-full" placeholder="12345" required />
      </div>
    </div>
  </div>
</section>

  <!-- SECTION 3: KONTAK & FISIK -->
  <section>
    <h3 class="text-xl font-semibold text-green-700 mb-4">Kontak & Data Fisik</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">No. HP Siswa <span class="text-green-500">*</span></label>
        <input type="tel" v-model="form.hp" class="form-input" placeholder="08xxxxxxxxxx" required />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telp Rumah</label>
        <input type="tel" v-model="form.telp_rumah" class="form-input" placeholder="021-xxxxxxx" />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Tinggi Badan (cm) <span class="text-green-500">*</span></label>
        <input type="number" v-model="form.tinggi_badan" class="form-input" placeholder="Contoh: 150" min="50" required />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Berat Badan (kg) <span class="text-green-500">*</span></label>
        <input type="number" v-model="form.berat_badan" class="form-input" placeholder="Contoh: 45" min="20" required />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Saudara <span class="text-green-500">*</span></label>
        <input type="number" v-model="form.jml_saudara" class="form-input" placeholder="0" min="0" required />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Anak Ke <span class="text-green-500">*</span></label>
        <input type="number" v-model="form.anak_ke" class="form-input" placeholder="1" min="1" required />
      </div>
    </div>
  </section>
</div>
            <!-- Section 2: Data Orang Tua -->
            <div class="mb-10">
              <h2 class="text-2xl font-bold text-green-800 mb-6 flex items-center">
                <span class="bg-green-100 text-green-800 rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-3">2</span>
                Data Orang Tua
              </h2>
 <div class="mb-6">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Pengasuh (Orang Tua/Wali)<span class="text-green-500">*</span></label>
      <label class="mr-6 font-medium text-gray-700">
        <input type="radio" value="orangtua" v-model="pengasuh" class="mr-1" />
         Orang Tua
      </label>
      <label class="font-medium text-gray-700">
        <input type="radio" value="wali" v-model="pengasuh" class="mr-1" />
         Wali
      </label>
    </div>
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Data Ayah -->
                <div v-if="pengasuh === 'orangtua'" class="bg-blue-50 p-6 rounded-xl">
                  <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <span class="mr-2"></span> Data Ayah
                  </h3>
                  <div class="space-y-4">
                    <div>
                      <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Ayah <span class="text-green-500">*</span>
                      </label>
                      <input
                        type="text"
                        v-model="form.nama_ayah"
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                        placeholder="Nama lengkap ayah"
                        required
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tahun Lahir <span class="text-green-500">*</span>
                      </label>
                      <input
                        type="number"
                        v-model="form.tahun_ayah"
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                        placeholder="1980"
                        min="1950"
                        max="2010"
                        required
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Pekerjaan <span class="text-green-500">*</span>
                      </label>
                      <input
                        type="text"
                        v-model="form.pekerjaan_ayah"
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                        placeholder="Pekerjaan ayah"
                        required
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Penghasilan per Bulan <span class="text-green-500">*</span>
                      </label>
                      <select
                        v-model="form.penghasilan_ayah"
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                        required
                      >
                        <option value="">Pilih rentang penghasilan</option>
                        <option value="< Rp 1.000.000">< Rp 1.000.000</option>
                        <option value="Rp 1.000.000 - Rp 3.000.000">Rp 1.000.000 - Rp 3.000.000</option>
                        <option value="Rp 3.000.000 - Rp 5.000.000">Rp 3.000.000 - Rp 5.000.000</option>
                        <option value="Rp 5.000.000 - Rp 10.000.000">Rp 5.000.000 - Rp 10.000.000</option>
                        <option value="> Rp 10.000.000">> Rp 10.000.000</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Data Ibu -->
                <div v-if="pengasuh === 'orangtua'" class="bg-pink-50 p-6 rounded-xl">
                  <h3 class="text-lg font-semibold text-pink-800 mb-4 flex items-center">
                    <span class="mr-2"></span> Data Ibu
                  </h3>
                  <div class="space-y-4">
                    <div>
                      <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Ibu <span class="text-green-500">*</span>
                      </label>
                      <input
                        type="text"
                        v-model="form.nama_ibu"
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 transition-all duration-200"
                        placeholder="Nama lengkap ibu"
                        required
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tahun Lahir <span class="text-green-500">*</span>
                      </label>
                      <input
                        type="number"
                        v-model="form.tahun_ibu"
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 transition-all duration-200"
                        placeholder="1985"
                        min="1950"
                        max="2010"
                        required
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Pekerjaan <span class="text-green-500">*</span>
                      </label>
                      <input
                        type="text"
                        v-model="form.pekerjaan_ibu"
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 transition-all duration-200"
                        placeholder="Pekerjaan ibu"
                        required
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Penghasilan per Bulan <span class="text-green-500">*</span>
                      </label>
                      <select
                        v-model="form.penghasilan_ibu"
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 transition-all duration-200"
                        required
                      >
                        <option value="">Pilih rentang penghasilan</option>
                        <option value="< Rp 1.000.000">< Rp 1.000.000</option>
                        <option value="Rp 1.000.000 - Rp 3.000.000">Rp 1.000.000 - Rp 3.000.000</option>
                        <option value="Rp 3.000.000 - Rp 5.000.000">Rp 3.000.000 - Rp 5.000.000</option>
                        <option value="Rp 5.000.000 - Rp 10.000.000">Rp 5.000.000 - Rp 10.000.000</option>
                        <option value="> Rp 10.000.000">> Rp 10.000.000</option>
                        <option value="Tidak Bekerja">Tidak Bekerja</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Data Wali -->
                <div v-if="pengasuh ==='wali'" class="bg-gray-50 p-6 rounded-xl">
                  <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="mr-2"></span> Data Wali
                  </h3>
                  <div class="space-y-4">
                    <div>
                      <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Wali <span class="text-green-500">*</span>
                      </label>
                      <input
                        type="text"
                        v-model="form.nama_wali"
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-gray-500 focus:ring-2 focus:ring-pink-200 transition-all duration-200"
                        placeholder="Nama lengkap wali"
                        required
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tahun Lahir <span class="text-green-500">*</span>
                      </label>
                      <input
                        type="number"
                        v-model="form.tahun_wali"
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-gray-500 focus:ring-2 focus:ring-pink-200 transition-all duration-200"
                        placeholder="1985"
                        min="1950"
                        max="2010"
                        required
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Pekerjaan <span class="text-green-500">*</span>
                      </label>
                      <input
                        type="text"
                        v-model="form.pekerjaan_wali"
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-gray-500 focus:ring-2 focus:ring-pink-200 transition-all duration-200"
                        placeholder="Pekerjaan wali"
                        required
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Penghasilan per Bulan <span class="text-green-500">*</span>
                      </label>
                      <select
                        v-model="form.penghasilan_wali"
                        class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-gray-500 focus:ring-2 focus:ring-pink-200 transition-all duration-200"
                        required
                      >
                        <option value="">Pilih rentang penghasilan</option>
                        <option value="< Rp 1.000.000">< Rp 1.000.000</option>
                        <option value="Rp 1.000.000 - Rp 3.000.000">Rp 1.000.000 - Rp 3.000.000</option>
                        <option value="Rp 3.000.000 - Rp 5.000.000">Rp 3.000.000 - Rp 5.000.000</option>
                        <option value="Rp 5.000.000 - Rp 10.000.000">Rp 5.000.000 - Rp 10.000.000</option>
                        <option value="> Rp 10.000.000">> Rp 10.000.000</option>
                        <option value="Tidak Bekerja">Tidak Bekerja</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Section 3: Upload Dokumen -->
            <div class="mb-10">
              <h2 class="text-2xl font-bold text-green-800 mb-6 flex items-center">
                <span class="bg-green-100 text-green-800 rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-3">3</span>
                Upload Dokumen
              </h2>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-green-50 p-6 rounded-xl">
                  <h3 class="text-lg font-semibold text-green-800 mb-4 flex items-center">
                    <span class="mr-2">📄</span> Dokumen Persyaratan
                  </h3>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Upload Dokumen (PDF) <span class="text-green-500">*</span>
                  </label>
                  <input
                    type="file"
                    @change="handleFileUpload"
                    accept="application/pdf"
                    class="w-full p-4 border-2 border-dashed border-green-300 rounded-lg bg-white hover:border-green-500 transition-colors duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                    required
                  />
                  <div class="mt-3 text-sm text-gray-600">
                    <p class="font-medium mb-2">Dokumen yang diperlukan:</p>
                    <ul class="list-disc list-inside space-y-1 text-xs">
                      <li>Ijazah SMP/MTS atau Surat Keterangan Lulus</li>
                      <li>Akta Kelahiran</li>
                      <li>Kartu Keluarga (KK)</li>
                      <li>Surat Keterangan NISN</li>
                      <li>KTP Orang Tua</li>
                      <li>Kartu Indonesia Pintar (KIP) - jika ada</li>
                    </ul>
                    <p class="mt-2 text-xs text-green-700 font-medium">
                      * Gabungkan semua dokumen dalam 1 file PDF (maksimal 5MB)
                    </p>
                  </div>
                </div>

                <div class="bg-purple-50 p-6 rounded-xl">
                  <h3 class="text-lg font-semibold text-purple-800 mb-4 flex items-center">
                    <span class="mr-2">📷</span> Pas Foto
                  </h3>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Upload Foto 3x4 (JPG/PNG) <span class="text-green-500">*</span>
                  </label>
                  <input
                    type="file"
                    @change="handleFotoUpload"
                    accept="image/jpeg, image/png"
                    class="w-full p-4 border-2 border-dashed border-purple-300 rounded-lg bg-white hover:border-purple-500 transition-colors duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100"
                    required
                  />
                  <div class="mt-3 text-sm text-gray-600">
                    <p class="font-medium mb-2">Persyaratan foto:</p>
                    <ul class="list-disc list-inside space-y-1 text-xs">
                      <li>Ukuran 3x4 cm</li>
                      <li>Latar belakang merah</li>
                      <li>Foto terbaru (diambil dalam 6 bulan terakhir)</li>
                      <li>Wajah tampak jelas dan tidak menggunakan kacamata</li>
                      <li>Format JPG/PNG (maksimal 2MB)</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
              <button
                type="submit"
                class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white text-lg font-semibold px-8 py-4 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center mx-auto"
              >
                Kirim Pendaftaran
              </button>
              <p class="text-sm text-gray-500 mt-4">
                Pastikan semua data sudah benar sebelum mengirim
              </p>
            </div>
          </div>
        </form>
      </div>
    </div>
    <ErrorModal
  :show="showErrorModal"
  :title="errorTitle"
  :message="errorMessage"
/>
<SuccessModal
  :show="showSuccessModal"
  title="Pendaftaran Berhasil"
/>

  </AppLayout>

</template>
<style>
.form-input {
  @apply w-full p-4 border-2 border-gray-200 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200;
}
.form-select {
  @apply w-full p-4 border-2 border-gray-200 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200;
}
</style>
<script setup>
import AppLayout from '../../layouts/AppLayout.vue'
import { ref, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import AOS from 'aos'
import 'aos/dist/aos.css'
import ErrorModal from '../../components/ErrorModal.vue';
import SuccessModal from '../../components/SuccessModal.vue';
const showErrorModal = ref(false)
const showSuccessModal = ref(false)
const errorTitle = ref('Gagal Mendaftar')
const errorMessage = ref('')

const pengasuh = ref('orangtua') // Default to orangtua
const form = ref({
   nama: '',
    pilihan_program: '',
    tempat_tanggal_lahir: '',
    jenis_kelamin: '',
    agama: '',
    nisn: '',
    telp_rumah: '',
    asal_sekolah: '',
    alamat: '',
    alamat_ortu: '',
    provinsi: '',
    kabupaten: '',
    kecamatan: '',
    desa: '',
    kode_pos: '',
    rt: '',
    rw: '',
    tinggi_badan: '',
    berat_badan: '',
kip: null,
    nomor_kip: '',
    jml_saudara: '',
    anak_ke: '',
    hp: '',
    nama_ayah: '',
    tahun_ayah: '',
    pekerjaan_ayah: '',
    penghasilan_ayah: '',
    nama_ibu: '',
    tahun_ibu: '',
    pekerjaan_ibu: '',
    penghasilan_ibu: '',
     nama_wali: '',
  tahun_wali: '',
  pekerjaan_wali: '',
  penghasilan_wali: '',
    dokumen: null,
    foto: null,
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

function handleFotoUpload(e) {
  const file = e.target.files[0]
  if (file && (file.type === 'image/jpeg' || file.type === 'image/png')) {
    form.value.foto = file
  } else {
    alert('Mohon unggah foto JPG atau PNG.')
    e.target.value = null
  }
}

function resetForm() {
  form.value = {
    nama: '',
    pilihan_program: '',
    tempat_tanggal_lahir: '',
    jenis_kelamin: '',
      alamat: '',
    alamat_ortu: '',
    agama: '',
    nisn: '',
    telp_rumah: '',
    asal_sekolah: '',
    provinsi: '',
    kabupaten: '',
    kecamatan: '',
    desa: '',
    kode_pos: '',
    rt: '',
    rw: '',
    tinggi_badan: '',
    berat_badan: '',
    kip: null,
    nomor_kip: '',
    jml_saudara: '',
    anak_ke: '',
    hp: '',
    nama_ayah: '',
    tahun_ayah: '',
    pekerjaan_ayah: '',
    penghasilan_ayah: '',
    nama_ibu: '',
    tahun_ibu: '',
    pekerjaan_ibu: '',
    penghasilan_ibu: '',
     nama_wali: '',
  tahun_wali: '',
  pekerjaan_wali: '',
  penghasilan_wali: '',
    dokumen: null,
    foto: null,
  }
}

function submitForm() {
  console.log('📦 Form Data Sebelum Submit:', form.value)

  const formData = new FormData()
  for (const key in form.value) {
    formData.append(key, form.value[key])
  }

  router.post('/spmb', formData, {
    forceFormData: true,
    onSuccess: () => {
showSuccessModal.value = true
  // Tutup modal otomatis setelah 5 detik
  setTimeout(() => {
    showSuccessModal.value = false
  }, 5000) // 5000 ms = 5 detik      resetForm()
    },
  onError: (errors) => {
  console.error(errors)

  const pesanList = Object.values(errors)
    .flat()
    .join('\n')

  errorTitle.value = 'Gagal'
  errorMessage.value = pesanList
  showErrorModal.value = true

  // Tutup modal otomatis setelah 5 detik
  setTimeout(() => {
    showErrorModal.value = false
  }, 5000) // 5000 ms = 5 detik
}


  })
}


onMounted(() => {
  AOS.init({
    once: true,
    duration: 1000,
  })
              document.title = 'Formulir SPMB - SMK Maarif NU 1 Ketanggungan'

})
</script>
