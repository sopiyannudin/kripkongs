# 🌽 Kripkongs - Web UMKM Keripik Singkong Premium

Aplikasi web sistem pemesanan dan katalog digital untuk UMKM Kripkongs. Proyek ini dikembangkan menggunakan framework Laravel untuk memenuhi Tugas Praktikum Cloud Computing Universitas Pamulang.

## 👥 Anggota Kelompok 3

- **Arini** (Cloud Architect / Ketua)
- **Naja** (Infrastructure Engineer)
- **Sopiyan** (Security & Governance Officer)
- **Fauzan** (Cost & Operations Analyst)

## 🚀 Fitur Utama

1. **Katalog Produk Publik:** Beranda interaktif, katalog digital lengkap dengan varian rasa, dan formulir pemesanan online.
2. **Dashboard Admin Terproteksi:**
   - *Ringkasan Admin:* Monitoring statistik total produk dan pesanan masuk secara langsung.
   - *Kelola Produk:* Manajerial CRUD (Tambah, Edit, Hapus) serta fitur unggah gambar produk.
   - *Pesanan Masuk:* Manajemen pemrosesan status pesanan pelanggan.
3. **Keamanan & Middleware Otentikasi:** Proteksi ketat pada seluruh rute `/admin/dashboard` untuk mencegah akses dari pengguna tanpa hak akses (Guest/Publik).
4. **Endpoint Health Check:** Fitur pemantauan server melalui endpoint `/health` yang mengembalikan respons `OK` (HTTP status 200).

## 🛠️ Spesifikasi Teknologi & Infrastruktur Cloud

- **Framework Backend:** Laravel (PHP 8.3)
- **Database:** MySQL Server / MariaDB
- **Frontend:** HTML5, Bootstrap 5, FontAwesome Icons, Poppins Font
- **Version Control:** Git & GitHub (`sopiyannudin/kripkongs`)
- **Cloud Provider:** IDCloudHost (cPanel Shared Hosting Paket Basic Pro - Data Center Jakarta, Indonesia)
- **Web Server Cloud:** LiteSpeed Web Server

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
cp .env.example .env
```

Buka file `.env` dan sesuaikan variabel koneksi database lokal Anda:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kripkongs_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Key & Migrasi Database

```bash
php artisan key:generate
php artisan migrate:fresh --seed
```

### 5. Jalankan Server Lokal

```bash
php artisan serve
```

Akses aplikasi melalui peramban di [http://127.0.0.1:8000](http://127.0.0.1:8000).

## ☁️ Arsitektur & Deployment Cloud (IDCloudHost)

Penggelaran (*deployment*) pada lingkungan produksi dilakukan menggunakan layanan cPanel Shared Hosting IDCloudHost dengan tahapan berikut:

1. **Penyediaan Server:** Menggunakan paket Basic Pro cPanel Shared Hosting IDCloudHost.
2. **Konfigurasi Lingkungan Server:** Menyesuaikan versi PHP menjadi PHP 8.3 (ea-php83) melalui fitur *MultiPHP Manager* cPanel dan mengaktifkan ekstensi pendukung via *PHP Selector*.
3. **Database:** Pembuatan basis data beserta *user credentials* dilakukan dengan aman melalui fitur *MySQL® Databases* cPanel.
4. **Penerapan Kode:** Menarik kode (*pull*) dari GitHub dan meletakkannya di *File Manager* (`public_html`).
5. **Konfigurasi Domain & Keamanan:** Penyesuaian konfigurasi aplikasi agar dapat diakses melalui domain utama dan aktivasi SSL/HTTPS otomatis menggunakan *AutoSSL Let's Encrypt* cPanel.

## 🔐 Keamanan & Pemantauan Sistem

- **Perlindungan Kredensial:** File sensitif `.env` diabaikan oleh Git melalui `.gitignore` untuk mencegah kebocoran data rahasia.
- **Uji Penetrasi Akses Admin:** Pengujian akses terlarang ke *dashboard admin* akan secara otomatis diblokir dan dikembalikan ke halaman utama dengan pesan peringatan.
- **Pemantauan Kesehatan Server:** Status ketersediaan server dapat dipantau publik kapan saja melalui akses ke URL **[https://kripkongs.my.id/health](https://kripkongs.my.id/health)**.

## 📄 Tujuan Proyek

Dokumentasi dan aplikasi web ini disusun untuk memenuhi Tugas Praktikum Cloud Computing Universitas Pamulang, sekaligus mengimplementasikan pengelolaan *cloud hosting* yang efisien, aman, dan mematuhi standar privasi data UMKM di Indonesia.