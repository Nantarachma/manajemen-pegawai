# SiManPeg — Sistem Informasi Manajemen Data Pegawai Berbasis Web

Aplikasi web untuk mengelola data pegawai secara efisien, dibangun menggunakan **Laravel** dan **SQLite**. Dibuat sebagai project Uji Kompetensi.

## 📋 Deskripsi

SiManPeg adalah sistem informasi berbasis web yang memudahkan admin dalam mengelola data pegawai. Aplikasi ini menyediakan fitur CRUD (Create, Read, Update, Delete) lengkap serta dashboard visual untuk melihat statistik data pegawai melalui grafik interaktif.

## ✨ Fitur Utama

### Kebutuhan Fungsional
- **Tambah Data Pegawai** — Admin dapat memasukkan data pegawai baru (NIP, nama, jenis kelamin, tanggal lahir, pendidikan terakhir, jabatan, alamat).
- **Lihat Data Pegawai** — Menampilkan seluruh data pegawai dalam bentuk tabel.
- **Edit Data Pegawai** — Admin dapat mengubah data pegawai yang sudah tersimpan.
- **Hapus Data Pegawai** — Admin dapat menghapus data pegawai dari sistem.
- **Dashboard Statistik** — Menampilkan 3 grafik visualisasi:
  - 📊 Grafik perbandingan jumlah pegawai laki-laki dan perempuan (Doughnut Chart)
  - 📊 Grafik pendidikan terakhir (Bar Chart)
  - 📊 Grafik sebaran usia pegawai berdasarkan rentang umur (Bar Chart)

### Kebutuhan Non-Fungsional
- **Konfirmasi Hapus** — Setiap aksi hapus data akan menampilkan pop-up konfirmasi (SweetAlert2) sebelum data benar-benar dihapus.
- **Autentikasi Admin** — Sistem dilindungi login. Hanya admin yang sudah login yang bisa mengakses data.

## 🛠️ Teknologi yang Digunakan

| Teknologi | Keterangan |
|-----------|------------|
| **Laravel** | Framework PHP untuk backend |
| **SQLite** | Database ringan berbasis file |
| **Blade** | Template engine bawaan Laravel |
| **Bootstrap 5** | Framework CSS untuk layout responsif |
| **Chart.js** | Library JavaScript untuk grafik interaktif |
| **SweetAlert2** | Library popup konfirmasi yang elegan |
| **Font Awesome 6** | Library ikon |
| **Google Fonts (Inter)** | Tipografi modern |

## 📁 Struktur Database

### Tabel `users`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary Key |
| name | string | Nama user |
| email | string | Email (unique) |
| password | string | Password (hashed) |
| timestamps | | Created at & Updated at |

### Tabel `pegawais`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary Key |
| nip | string | Nomor Induk Pegawai (unique) |
| nama | string | Nama lengkap pegawai |
| jenis_kelamin | enum | Laki-laki / Perempuan |
| tanggal_lahir | date | Tanggal lahir pegawai |
| pendidikan_terakhir | string | SMA/SMK, D3, S1, S2, S3 |
| jabatan | string | Jabatan pegawai |
| alamat | text | Alamat lengkap pegawai |
| timestamps | | Created at & Updated at |

## 🚀 Cara Instalasi & Menjalankan

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM (opsional, untuk asset frontend)

### Langkah-Langkah

1. **Clone repository**
   ```bash
   git clone https://github.com/Nantarachma/manajemen-pegawai.git
   cd manajemen-pegawai
   ```

2. **Install dependensi PHP**
   ```bash
   composer install
   ```

3. **Salin file environment**
   ```bash
   cp .env.example .env
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Pastikan konfigurasi database di `.env`**
   ```
   DB_CONNECTION=sqlite
   ```

6. **Jalankan migrasi dan seeder**
   ```bash
   php artisan migrate --seed
   ```
   > Jika muncul pertanyaan "Would you like to create it?", ketik `yes` untuk membuat file database SQLite.

7. **Jalankan server lokal**
   ```bash
   php artisan serve
   ```

8. **Buka browser**
   ```
   http://127.0.0.1:8000
   ```

## 🔐 Akun Default Admin

| Field | Value |
|-------|-------|
| **Email** | `admin@admin.com` |
| **Password** | `password` |

## 📄 Struktur Halaman

```
/ .......................... Halaman Login (Landing Page)
/dashboard ................. Dashboard Statistik Pegawai
/pegawai ................... Daftar Data Pegawai
/pegawai/create ............ Form Tambah Pegawai
/pegawai/{id}/edit ......... Form Edit Pegawai
```

## 📂 Struktur File Utama

```
manajemen-pegawai/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php          # Login & Logout
│   │   └── PegawaiController.php       # CRUD & Dashboard
│   └── Models/
│       ├── Pegawai.php                 # Model Pegawai
│       └── User.php                    # Model User
├── database/
│   ├── migrations/
│   │   ├── 2026_04_27_..._create_users_table.php
│   │   └── 2026_04_28_..._create_pegawais_table.php
│   └── seeders/
│       └── DatabaseSeeder.php          # Seeder admin default
├── resources/views/
│   ├── auth/
│   │   └── login.blade.php             # Halaman Login
│   ├── layouts/
│   │   └── app.blade.php               # Layout Utama (Sidebar)
│   └── pegawai/
│       ├── dashboard.blade.php         # Dashboard & Grafik
│       ├── index.blade.php             # Tabel Data Pegawai
│       ├── create.blade.php            # Form Tambah
│       └── edit.blade.php              # Form Edit
└── routes/
    └── web.php                         # Definisi Route
```

## 🎨 Desain UI

- **Tema**: Putih bersih dengan aksen gradient biru laut (Ocean Blue)
- **Login Page**: Split-screen — panel kiri gradient biru laut dengan animasi floating bubbles, panel kanan form putih
- **Dashboard**: Sidebar navigasi, stat cards dengan gradient icon, dan grafik Chart.js
- **Responsif**: Mendukung tampilan desktop dan mobile (sidebar otomatis collapse)

## 📝 Lisensi

Project ini dibuat untuk keperluan **Uji Kompetensi**.
