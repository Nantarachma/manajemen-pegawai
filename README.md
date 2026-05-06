# SiManPeg — Sistem Informasi Manajemen Data Pegawai Berbasis Web

Aplikasi web untuk mengelola data pegawai secara efisien, dibangun menggunakan **Laravel** dan **SQLite**. Dibuat sebagai project Uji Kompetensi.

## 📋 Deskripsi

SiManPeg adalah sistem informasi berbasis web yang memudahkan admin dalam mengelola data pegawai. Aplikasi ini menyediakan fitur CRUD (Create, Read, Update, Delete) lengkap serta dashboard visual untuk melihat statistik data pegawai melalui grafik interaktif.

## ✨ Fitur Utama

### Kebutuhan Fungsional
- **Tambah Data Pegawai** — Admin dapat memasukkan data pegawai baru (NIP, nama, jenis kelamin, tanggal lahir, pendidikan terakhir, jabatan, alamat).
- **Lihat Data Pegawai** — Menampilkan data pegawai dalam tabel dengan **pagination** (10 data per halaman).
- **Edit Data Pegawai** — Admin dapat mengubah data pegawai yang sudah tersimpan.
- **Hapus Data Pegawai** — Admin dapat menghapus data pegawai dari sistem.
- **Pencarian & Filter** — Pencarian berdasarkan NIP/nama, filter berdasarkan jabatan, pendidikan, dan jenis kelamin, serta sorting kolom.
- **Import Data CSV** — Admin dapat mengimpor data pegawai secara massal dari file CSV.
- **Export Data CSV** — Admin dapat mengekspor seluruh data pegawai ke file CSV.
- **Audit Log** — Sistem mencatat setiap aktivitas (create, update, delete, import, export) beserta detail perubahannya.
- **Manajemen Profil Admin** — Admin dapat mengubah nama, email, dan password.
- **Dashboard Statistik** — Menampilkan 3 grafik visualisasi:
  - 📊 Grafik perbandingan jumlah pegawai laki-laki dan perempuan (Doughnut Chart)
  - 📊 Grafik pendidikan terakhir (Bar Chart)
  - 📊 Grafik sebaran usia pegawai berdasarkan rentang umur (Bar Chart)

### Kebutuhan Non-Fungsional
- **Konfirmasi Hapus** — Setiap aksi hapus data menampilkan pop-up konfirmasi (SweetAlert2).
- **Autentikasi Admin** — Sistem dilindungi login. Hanya admin yang sudah login yang bisa mengakses data.
- **Policy / Gate** — Kontrol akses per aksi menggunakan Laravel Policy.

### Arsitektur & Kualitas Kode
- **Form Request** — Validasi terpisah di `PegawaiRequest` (reusable untuk store & update).
- **Service Layer** — Logika statistik dashboard dipisah ke `PegawaiStatisticsService`.
- **Mass Assignment Aman** — Menggunakan `$request->only([...])` melalui method `safeData()`.
- **Automated Tests** — Test suite untuk autentikasi dan CRUD pegawai (14 test cases).

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

### Tabel `audit_logs`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary Key |
| user_id | bigint | FK → users |
| action | string | create / update / delete / import / export |
| model_type | string | Nama model (Pegawai) |
| model_id | bigint | ID record terkait |
| old_values | json | Nilai sebelum perubahan |
| new_values | json | Nilai setelah perubahan |
| ip_address | string | IP address pengguna |
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
/pegawai ................... Daftar Data Pegawai (Search, Filter, Sort, Pagination)
/pegawai/create ............ Form Tambah Pegawai
/pegawai/{id}/edit ......... Form Edit Pegawai
/pegawai-export ............ Download CSV Data Pegawai
/pegawai-import ............ Form Import CSV
/audit-log ................. Riwayat Aktivitas (Audit Log)
/profile ................... Manajemen Profil Admin
```

## 📂 Struktur File Utama

```
manajemen-pegawai/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php          # Login & Logout
│   │   │   ├── PegawaiController.php       # CRUD, Dashboard, Import/Export
│   │   │   ├── ProfileController.php       # Manajemen Profil
│   │   │   └── AuditLogController.php      # Riwayat Aktivitas
│   │   └── Requests/
│   │       └── PegawaiRequest.php          # Form Request Validation
│   ├── Models/
│   │   ├── Pegawai.php
│   │   ├── User.php
│   │   └── AuditLog.php
│   ├── Policies/
│   │   └── PegawaiPolicy.php              # Authorization Gate
│   ├── Providers/
│   │   └── AppServiceProvider.php         # Policy Registration
│   └── Services/
│       └── PegawaiStatisticsService.php   # Dashboard Logic
├── database/
│   ├── migrations/
│   │   ├── ..._create_users_table.php
│   │   ├── ..._create_pegawais_table.php
│   │   └── ..._create_audit_logs_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/views/
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── profile.blade.php
│   ├── audit/
│   │   └── index.blade.php
│   ├── layouts/
│   │   └── app.blade.php
│   └── pegawai/
│       ├── dashboard.blade.php
│       ├── index.blade.php
│       ├── create.blade.php
│       ├── edit.blade.php
│       └── import.blade.php
├── routes/
│   └── web.php
└── tests/Feature/
    ├── AuthTest.php                       # 5 test cases
    └── PegawaiTest.php                    # 11 test cases
```

## 🧪 Menjalankan Tests

```bash
php artisan test
```

## 🎨 Desain UI

- **Tema**: Putih bersih dengan aksen gradient biru laut (Ocean Blue)
- **Login Page**: Split-screen — panel kiri gradient biru laut dengan animasi floating bubbles, panel kanan form putih
- **Dashboard**: Sidebar navigasi, stat cards dengan gradient icon, dan grafik Chart.js
- **Responsif**: Mendukung tampilan desktop dan mobile (sidebar otomatis collapse)

## 📝 Lisensi

Project ini dibuat untuk keperluan **Uji Kompetensi**.
