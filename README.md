# 🌽 Kripkongs - Web UMKM Keripik Singkong Premium

Aplikasi web sistem pemesanan dan katalog digital untuk UMKM **Kripkongs**. Proyek ini dikembangkan menggunakan framework Laravel untuk memenuhi Tugas Praktikum Cloud Computing Universitas Pamulang.

---

## 👥 Anggota Kelompok 3

- **Arini** - Cloud Architect (Ketua)
- **Naja** - Infrastructure Engineer
- **Sopiyan** - Security & Governance Officer
- **Fauzan** - Cost & Operations Analyst

---

## 🚀 Fitur Utama

1. **Katalog Produk Publik:** Beranda interaktif, katalog digital lengkap dengan 12+ varian rasa (Balado, BBQ, Keju, dll.), dan formulir pemesanan online.

2. **Dashboard Admin Terproteksi (3 Tab Utama):**
   - **Ringkasan Admin:** Monitoring statistik total produk dan pesanan masuk secara langsung.
   - **Kelola Produk:** Manajerial CRUD (Tambah, Edit, Hapus) serta fitur unggah gambar produk.
   - **Pesanan Masuk:** Manajemen pemrosesan status pesanan pelanggan (Baru, Diproses, Selesai).

3. **Keamanan & Middleware Otentikasi:** Proteksi ketat pada seluruh rute `/admin/dashboard` untuk mencegah akses dari pengguna tanpa hak akses (Guest/Publik).

4. **Endpoint Health Check:** Fitur pemantauan server melalui *endpoint* `/health` yang mengembalikan respons `OK` (HTTP status 200).

---

## 🛠️ Spesifikasi Teknologi & Infrastruktur Cloud

- **Framework Backend:** Laravel (PHP 8.2)
- **Database:** MySQL Server
- **Frontend:** HTML5, Bootstrap 5, FontAwesome Icons, Poppins Font
- **Version Control:** Git & GitHub (`sopiyannudin/kripkongs`)
- **Cloud Provider:** IDCloudHost (Virtual Machine Ubuntu Linux - Data Center Jakarta, Indonesia)
- **Web Server Cloud:** Nginx & PHP-FPM 8.2

---

## 💻 Panduan Menjalankan Aplikasi Secara Lokal

### 1. Clone Repository

```bash
git clone https://github.com/sopiyannudin/kripkongs.git
cd kripkongs
```

### 2. Instal Dependensi PHP

```bash
composer install
```

### 3. Konfigurasi Environment File

Salin file `.env.example` menjadi `.env`:

```bash
# Untuk Linux / macOS / Git Bash
cp .env.example .env

# Untuk Windows Command Prompt
copy .env.example .env
```

Buka file `.env` dan sesuaikan variabel koneksi database lokal Anda:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kripkongs_db
DB_USERNAME=kripkongs_user
DB_PASSWORD=kripkongs_1234
```

### 4. Generate Key & Migrasi Database

```bash
# Generate Key Aplikasi
php artisan key:generate

# Jalankan Migrasi dan Seeding Data Produk Awal
php artisan migrate:fresh --seed
```

### 5. Jalankan Server Lokal

```bash
php artisan serve
```

Akses aplikasi melalui peramban di `http://127.0.0.1:8000`.

---

## ☁️ Arsitektur & Deployment Cloud (IDCloudHost)

Deployment pada lingkungan produksi dilakukan pada Virtual Machine IDCloudHost dengan tahapan berikut:

1. **Penyediaan Server:** Mempersiapkan Virtual Machine Ubuntu LTS di Data Center Jakarta.
2. **Instalasi LEMP Stack:** Konfigurasi Nginx, PHP 8.2 FPM, MySQL Server, Git, dan Composer.
3. **Penerapan Kode:** Melakukan penarikan (*pull/clone*) kode langsung dari repositori GitHub.
4. **Konfigurasi Lingkungan:** Pengesetan file `.env` produksi, *generate app key*, serta eksekusi migrasi database (`php artisan migrate:fresh --seed --force`).
5. **Izin Hak Akses File:** Pengaturan hak akses folder `storage` dan `bootstrap/cache` ke pengguna `www-data`.
6. **Server Block Nginx:** Pengesetan direktori `public` Laravel sebagai *root directory* dan mengaktifkan respons `OK` pada lokasi `/health`.

---

## 🔐 Keamanan & Pemantauan Sistem

- **Perlindungan Kredensial:** File sensitif `.env` diabaikan oleh Git melalui `.gitignore` untuk mencegah kebocoran data rahasia.
- **Uji Penetrasi Akses Admin:** Pengujian URL `/admin/dashboard` menggunakan mode penyamaran (*Incognito*) terbukti secara otomatis memblokir *guest* dan mengarahkan kembali ke halaman utama dengan pesan peringatan.
- **Pemantauan Kesehatan Server:** Status ketersediaan server dapat dipantau kapan saja melalui akses ke URL `http://[IP_PUBLIK_SERVER]/health`.

---

## 📄 Tujuan Proyek

Dokumentasi dan proyek aplikasi web ini disusun untuk memenuhi **Tugas Praktikum Cloud Computing Universitas Pamulang**, sekaligus menerapkan praktik terbaik dalam pengembangan aplikasi web modern, manajemen database, *version control*, proteksi keamanan, dan *deployment* server *cloud*.
