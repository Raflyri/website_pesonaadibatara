# Product Specification Document (PRD)

**Project Name:** Website Company Profile PT. Pesona Adi Batara (PAB)
**Version:** 1.0
**Framework:** CodeIgniter 4
**Document Status:** Final (Generated based on existing codebase)

---

## 1. Pendahuluan (Introduction)

### 1.1 Tujuan Dokumen
Dokumen Spesifikasi Produk (Product Specification Document / PRD) ini dibuat untuk mendefinisikan seluruh fitur, arsitektur, dan spesifikasi teknis dari website *company profile* PT. Pesona Adi Batara. Dokumen ini menjadi acuan utama bagi developer, administrator, dan pemangku kepentingan (stakeholders) dalam memahami fungsionalitas sistem.

### 1.2 Deskripsi Produk
Website PT. Pesona Adi Batara adalah platform digital berbasis antarmuka web (web-based) yang dirancang untuk menampilkan profil perusahaan, layanan yang ditawarkan, berita/artikel terbaru, serta informasi kontak. Website ini dilengkapi dengan *Content Management System* (CMS) khusus yang memungkinkan administrator untuk mengelola konten website secara dinamis tanpa perlu mengubah kode sumber.

---

## 2. Target Pengguna (Target Audience)

1. **Pengunjung Umum (Public Visitors/Clients):** Calon klien atau masyarakat umum yang mencari informasi mengenai layanan, legalitas, portofolio, dan berita terkait PT. Pesona Adi Batara.
2. **Pencari Kerja (Job Seekers):** Individu yang mengakses halaman Karir untuk mencari informasi lowongan pekerjaan.
3. **Administrator (Super Admin):** Staf internal atau webmaster yang bertugas mengelola konten website, memantau statistik pengunjung, dan mengatur pengaturan sistem melalui Admin Panel.

---

## 3. Fitur Utama & Kebutuhan Fungsional (Core Features)

Sistem dibagi menjadi dua bagian utama: **Public Frontend** (Antarmuka Pengunjung) dan **Admin Panel CMS** (Antarmuka Administrator).

### 3.1 Public Frontend (Antarmuka Pengunjung)

Antarmuka yang diakses oleh publik bersifat responsif dan mendukung multi-bahasa (Bilingual: Indonesia & Inggris).

1. **Sistem Multi-Bahasa (i18n):**
   - Website mendukung fitur peralihan bahasa (Language Switcher).
   - Seluruh elemen statis pada tampilan antarmuka dan konten dinamis (seperti *tagline*, deskripsi web) dari database mendukung lokalisasi.

2. **Beranda (Home):**
   - **Hero Banner:** Menampilkan *carousel/slider* gambar utama yang dinamis.
   - **Layanan Kami (Services):** Menampilkan ringkasan layanan perusahaan.
   - **Mengapa Memilih Kami (Why Choose Us):** Menampilkan keunggulan kompetitif perusahaan.
   - **Berita & Artikel Terbaru:** Menampilkan 3 berita dan 3 artikel terbaru.
   - **Mitra/Klien (Partners):** Menampilkan logo-logo klien atau mitra kerja yang dikelola secara dinamis.

3. **Tentang Kami (About Us):**
   - Menampilkan sejarah, visi, misi, dan profil perusahaan.
   - **Struktur Dewan Direksi (Team):** Menampilkan profil manajemen inti beserta jabatan dan foto.

4. **Layanan (Services):**
   - Halaman detail yang menjelaskan masing-masing layanan yang ditawarkan secara komprehensif.

5. **Berita & Artikel (News/Blog):**
   - Halaman arsip yang memisahkan kategori antara "Berita" dan "Artikel".
   - Fitur detail berita lengkap dengan gambar sampul dan tanggal publikasi.

6. **Karir (Career):**
   - Halaman informasi lowongan pekerjaan (jika ada).

7. **Kontak (Contact Us):**
   - Formulir kontak untuk mengirimkan pesan langsung ke email atau database perusahaan.
   - Informasi kontak perusahaan yang terintegrasi langsung dengan database (Telepon, Email, Alamat).
   - **Integrasi WhatsApp Dinamis:** Tombol WhatsApp langsung yang nomornya diambil dari pengaturan database.
   - Peta Lokasi (Google Maps).

8. **SEO & Sitemap:**
   - URL *friendly* untuk SEO.
   - Halaman `sitemap.xml` yang di-generate secara dinamis untuk memudahkan indexing oleh mesin pencari (Google).

### 3.2 Admin Panel CMS (Antarmuka Administrator)

Akses ke panel ini dilindungi oleh autentikasi (Login/Logout) pada route `/panel-pab`.

1. **Dashboard & Analitik:**
   - Menampilkan ringkasan data.
   - Modul pelacakan statistik pengunjung website harian/bulanan (Visitor Counter terintegrasi dengan API).

2. **Manajemen Halaman Statis (Page Editors):**
   - **Home Editor:** Mengubah teks, tagline, dan struktur konten di halaman Beranda.
   - **About Editor:** Mengubah konten teks profil, visi, dan misi di halaman Tentang Kami.
   - **Contact Editor:** Mengubah informasi detail kontak (Alamat, Nomor Telepon, WhatsApp, Email, dan tautan sosial media).

3. **Manajemen Modul Dinamis (CRUD):**
   - **Manajemen Banner (Hero Slider):** Tambah, edit, hapus, dan atur status aktif banner.
   - **Manajemen Berita/Artikel (News):** Editor berbasis teks (Rich Text) untuk menerbitkan, mengedit, atau menghapus artikel.
   - **Manajemen Layanan (Services):** Menambah, mengedit, dan menghapus penawaran layanan.
   - **Manajemen Tim (Team):** Mengelola daftar anggota Dewan Direksi beserta jabatannya.
   - **Manajemen Mitra (Partners):** Mengelola logo klien/mitra yang ditampilkan di Beranda.

4. **Manajemen Media (Media Library):**
   - Sistem terpusat untuk mengunggah (upload), menelusuri, dan menghapus berkas gambar/dokumen pendukung.

5. **Manajemen Pengguna & Sistem:**
   - **Manajemen Pengguna (Users):** Menambah akun admin baru atau mengedit akses admin.
   - **Profil Admin:** Mengubah password dan profil akun admin yang sedang login.
   - **Backup Database (`backup-db`):** Fitur untuk melakukan pencadangan pangkalan data (database) dengan sekali klik.

---

## 4. Struktur Database & Model Data (Architecture Data)

Aplikasi dibangun menggunakan konsep arsitektur **MVC (Model-View-Controller)** dari CodeIgniter 4. Tabel/Model utama yang digunakan:

1. `SiteSettingModel` (`site_settings`): Menyimpan konfigurasi global website (Phone, Address, WhatsApp, Taglines). Mendukung pemanggilan data lokal sesuai bahasa (contoh: `company_tagline_en`).
2. `BannerModel` (`banners`): Menyimpan data gambar banner dan status tayang.
3. `NewsModel` (`news`): Menyimpan konten artikel/berita, kategori, tanggal publikasi, dan slug.
4. `ServiceModel` (`services`): Menyimpan rincian setiap layanan.
5. `TeamModel` (`team`): Menyimpan profil direksi.
6. `PartnersModel` (`partners`): Menyimpan logo klien dengan urutan penampilan (display order).
7. `VisitorModel` (`visitors`): Mencatat riwayat trafik dan alamat IP pengunjung untuk analitik Dashboard.
8. `UserModel` (`users`): Menyimpan kredensial otentikasi administrator (Username, Password Hashing).

---

## 5. Kebutuhan Non-Fungsional (Non-Functional Requirements)

1. **Teknologi Backend:** PHP 8.x, Framework CodeIgniter 4.
2. **Teknologi Frontend:** HTML5, CSS3 (Custom CSS seperti `style.css`, `header.css`), JavaScript, Bootstrap/Framework CSS pendukung.
3. **Database:** MySQL / MariaDB.
4. **Keamanan:**
   - Autentikasi Admin (Session & Hash Password).
   - Filter `authGuard` pada semua rute Admin (`/panel-pab/*`).
   - Perlindungan CSRF pada setiap form (CodeIgniter Security).
5. **Kinerja (Performance):** Minimalisasi pemanggilan database melalui struktur *query* yang teroptimasi, serta struktur file statis yang di-cache di *browser*.

---

## 6. Alur Pengguna (User Flow)

- **Klien / Publik:** Membuka URL website $\rightarrow$ Melihat Beranda $\rightarrow$ Mengganti Bahasa (Opsional) $\rightarrow$ Navigasi ke Layanan/Tentang Kami/Kontak $\rightarrow$ Klik tombol WhatsApp atau isi Form Kontak.
- **Admin:** Membuka `/login` $\rightarrow$ Memasukkan kredensial $\rightarrow$ Dialihkan ke `/panel-pab/dashboard` $\rightarrow$ Memilih menu editor (misal: *News* atau *Home Editor*) $\rightarrow$ Melakukan perubahan (Simpan) $\rightarrow$ Perubahan instan terlihat di website publik.

---
*Dokumen ini merupakan abstraksi fungsional teknis dari arsitektur proyek saat ini. Setiap penambahan fitur baru harus disertakan pada dokumen revisi selanjutnya.*
