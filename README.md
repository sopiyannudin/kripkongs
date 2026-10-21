# Kripkongs - Web UMKM Keripik Singkong Premium

Aplikasi web sistem pemesanan dan katalog digital untuk UMKM **Kripkongs**, dikembangkan menggunakan framework Laravel untuk memenuhi Tugas Praktikum Cloud Computing Universitas Pamulang.

---

## 👥 Anggota Kelompok 3

- **Arini** - Cloud Architect (Ketua)
- **Naja** - Infrastructure Engineer
- **Sopiyan** - Security & Governance Officer
- **Fauzan** - Cost & Operations Analyst

---

## 🚀 Fitur Utama

1. **Halaman Publik:** Beranda, katalog produk dengan minimal 5 varian, dan formulir pemesanan online.
2. **Dashboard Admin (3 Tab):**
   - **Ringkasan Admin:** Statistik total produk dan pesanan terbaru.
   - **Kelola Produk:** Tambah, edit, hapus, dan unggah gambar produk.
   - **Pesanan Masuk:** Mengelola status pesanan pelanggan (Baru, Diproses, Selesai).
3. **Keamanan dan Middleware:** Proteksi halaman `/admin/dashboard` khusus pengguna dengan role Admin.
4. **Health Check Endpoint:** Endpoint `/health` yang mengembalikan respons `OK` untuk pemantauan server cloud.

---

## 🛠️ Teknologi & Infrastruktur Cloud

- **Framework:** Laravel
- **Bahasa Pemrograman:** PHP 8.2
- **Database:** MySQL
- **Frontend:** HTML5, Bootstrap 5, CSS, JavaScript, Font Awesome, dan Poppins Font.
- **Cloud Provider:** IDCloudHost.
- **Sistem Operasi Cloud:** Ubuntu Linux.
- **Web Server:** Nginx.
- **Version Control:** Git dan GitHub.

---

## 💻 Cara Menjalankan Aplikasi Secara Lokal

### 1. Clone Repository

Jalankan perintah berikut di terminal:

```bash
git clone https://github.com/SOPIYAN-3/kripkongs.git
cd kripkongs
```

### 2. Instal Dependensi

Pastikan PHP, Composer, Node.js, dan npm sudah terpasang.

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`.

Untuk Windows Command Prompt:

```bat
copy .env.example .env
```

Kemudian buat application key:

```bash
php artisan key:generate
```

### 4. Konfigurasi Database

Buat database MySQL sesuai konfigurasi proyek, lalu sesuaikan pengaturan berikut di file `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kripkongs_db
DB_USERNAME=kripkongs_user
DB_PASSWORD=isi_password_database
```

Ganti `isi_password_database` dengan password database yang benar.

Jalankan migrasi database:

```bash
php artisan migrate
```

Jika proyek menyediakan seeder dan membutuhkan data awal, jalankan:

```bash
php artisan db:seed
```

### 5. Jalankan Aplikasi

Bangun aset frontend:

```bash
npm run build
```

Kemudian jalankan server pengembangan Laravel:

```bash
php artisan serve
```

Buka aplikasi melalui alamat:

`http://127.0.0.1:8000`

---

## ☁️ Deployment Cloud dengan IDCloudHost

Aplikasi Kripkongs menggunakan IDCloudHost sebagai penyedia layanan cloud. Deployment pada server cloud dilakukan melalui tahapan berikut:

1. Menyiapkan Virtual Machine (VM) dengan sistem operasi Ubuntu Linux.
2. Menginstal PHP beserta ekstensi Laravel, Composer, MySQL, Node.js, dan Nginx sesuai kebutuhan aplikasi.
3. Mengambil source code dari repository GitHub.
4. Mengatur konfigurasi `.env` untuk lingkungan produksi.
5. Menyiapkan database dan menjalankan migrasi.
6. Mengatur izin direktori `storage` dan `bootstrap/cache`.
7. Mengonfigurasi Nginx agar mengarah ke direktori `public` Laravel.
8. Menguji halaman publik, dashboard admin, pemesanan, dan endpoint `/health`.

**Catatan:** Sesuaikan dokumentasi ini dengan konfigurasi dan tahapan deployment yang benar-benar dilakukan pada server IDCloudHost.

---

## 🔐 Keamanan Aplikasi

- File `.env` tidak boleh diunggah ke repository publik.
- Gunakan `APP_DEBUG=false` pada lingkungan produksi.
- Lindungi halaman admin dengan autentikasi dan otorisasi.
- Gunakan kredensial database yang aman dan memiliki hak akses seperlunya.
- Aktifkan HTTPS setelah domain dan sertifikat SSL dikonfigurasi.

---

## 📄 Tujuan Proyek

Proyek ini dibuat untuk memenuhi Tugas Praktikum Cloud Computing Universitas Pamulang sekaligus menerapkan pengembangan aplikasi web, pengelolaan database, version control, keamanan aplikasi, dan deployment pada layanan cloud.

