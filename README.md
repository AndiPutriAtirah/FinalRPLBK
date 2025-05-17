# EDUZAIR

## 1. Komponen Autentikasi dan Otorisasi
### Laravel Bawaan
- **Fungsi**: Menyediakan sistem login/logout dasar untuk dosen dan mahasiswa
- **Implementasi**: 
  - Menggunakan middleware `auth` untuk proteksi route
  - Sistem validasi credential dengan bcrypt hashing
  - Mengelola session pengguna

### Spatie Laravel-Permission
- **Fungsi**: Mengatur hak akses berbasis role (admin, dosen, mahasiswa)
- **Implementasi**:
  - Membuat permission seperti `kelola-kursus`, `nilai-mahasiswa`
  - Assign role ke user dengan `$user->assignRole('dosen')`
  - Proteksi route dengan `can:kelola-kursus`

### Laravel Shield
- **Fungsi**: Mengamankan sistem dari serangan umum
- **Implementasi**:
  - Mencegah brute force attack pada halaman login
  - Membatasi rate API request
  - Menambahkan header keamanan HTTP

## 2. Komponen Manajemen Konten
### Filament
- **Fungsi**: Admin panel untuk mengelola konten pembelajaran
- **Implementasi**:
  - CRUD materi kursus dan modul
  - Form upload dokumen dan video
  - Tampilan daftar mahasiswa terdaftar

### Spatie Media Library
- **Fungsi**: Mengelola file materi pembelajaran
- **Implementasi**:
  - Menyimpan PDF silabus dengan `$course->addMedia()`
  - Generate thumbnail untuk gambar modul
  - Mengorganisir file per mata kuliah

## 3. Komponen Database
### Eloquent ORM
- **Fungsi**: Interaksi dengan database MySQL
- **Implementasi**:
  - Relasi antar tabel (kursus, modul, user)
  - Query builder untuk laporan akademik
  - Sistem migrasi database

## 4. Komponen Tambahan
### Laravel Notifications
- **Fungsi**: Mengirim notifikasi ke pengguna
- **Implementasi**:
  - Email pemberitahuan tugas baru
  - Notifikasi web ketika nilai diumumkan
  - Pengingat jadwal kuliah

---
