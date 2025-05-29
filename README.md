# SIMBAYANPUS
![image](https://github.com/user-attachments/assets/5ba899f9-baa6-4dae-9ce5-44b930ac980f)
![image](https://github.com/user-attachments/assets/c8303b02-49b6-4b10-a8b7-e319fb0c926a)


## Fitur
- Front User
    - Login (Login.vue)
    - Register (Register.vue)
    - Home Page (Home.vue)
    - Permohonan/Pengajuan Magang (BuatPermohonan.vue
    - Kontak/ Pesan (Kontak.vue, Pesan.vue)
    - Status Permohonan/Pengajuan (Permohonan.vue_
    - Profil (Profil.vue)
    - Informasi Divisi (Divisi.vue)
    - Surat Pernyataan (Surat-Pernyataan.vue)
- Dashboard (Filament)
    - Data Magang (AdminPanel)
    - Pendaftaran Masuk (PermohonanResource
    - Pendaftaran Diproses (UserDetailResource)
    - Pendaftaran Diterima (PermohonanDiterimaResource)
    - Magang Aktif (MagangAktifResource)
    - Magang Selesai (MagangSelesaiResource)
    - Kirim Dokumen (DokumenResource)
    - Kirim Pesan (PesanResource)
    - Log Activity (ActivitylogResource)

## Prerequisites
- PHP >= 8.0
- Composer
- Node.js & NPM
- Git
- MySQL/MariaDB
## Tech Stack
- Laravel 11
- Inertia Js
- Vue Js
- Tailwind CSS
- Laravel Filament
## Installation Steps

1. Clone the repository
```bash
git clone https://github.com/Rifqifauu/simbayanpus.git
```

2. Navigate to project directory
```bash
cd simbayanpus
```

3. Install PHP dependencies
```bash
composer install
```

4. Install Node.js dependencies
```bash
npm install
```

5. Create symbolic link for storage
```bash
php artisan storage:link
```

6. Environment Setup
- Copy `.env.example` to `.env`
- Configure your database settings
- Set APP_URL according to your local PHP server path

7. Database Setup
```bash
# Run migrations
php artisan migrate

# Seed the database with admin and superadmin accounts
php artisan db:seed
```

8. Build Assets
```bash
npm run build
#or
npm run dev
```

9. Start the development server
```bash
php artisan serve
```

The application should now be running at `http://localhost:8000`

## Default Accounts
After running the seeder, you'll have access to the following accounts:
- Admin account (email: admin@example.com, password: iamadmin)
- Superadmin account (email: superadmin@example.com, password: iamsuper)
Use /admin or /login/admin, but you can use /login too.

**Import divisi.sql** ke dalam database yg telah dibuat **(simbayanpus)** untuk mendapatkan data divisi/layanan yg sebelumnya sudah ada.
