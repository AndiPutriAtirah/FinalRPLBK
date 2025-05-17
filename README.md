# EDUZAIR

## 1. Komponen Autentikasi dan Otorisasi
### Laravel Bawaan
- **Fungsi**: Menyediakan sistem login/logout dasar untuk dosen dan mahasiswa
- **Implementasi**: 
  - Menggunakan middleware `auth` untuk proteksi route
  - Sistem validasi credential dengan bcrypt hashing
  - Mengelola session pengguna

## 2. Komponen Otorisasi Hak Akses
### Shield Plugin based on Spatie Laravel-Permission
- **Fungsi**: Plugin Filament untuk mengatur hak akses berbasis role (admin, dosen, mahasiswa)
- **Implementasi**:
  - Membuat permission seperti `kelola-kursus`, `nilai-mahasiswa`
  - Assign role ke user dengan `$user->assignRole('dosen')`
  - Proteksi route dengan `can:kelola-kursus`

## 3. Komponen Manajemen Konten
### Filament
- **Fungsi**: Admin panel untuk mengelola konten pembelajaran
- **Implementasi**:
  - CRUD materi kursus dan modul
  - Form upload dokumen dan video
  - Tampilan daftar mahasiswa terdaftar

## 4. Komponen Database
### Eloquent ORM
- **Fungsi**: Interaksi dengan database MySQL
- **Implementasi**:
  - Relasi antar tabel (kursus, modul, user)
  - Query builder untuk laporan akademik
  - Sistem migrasi database

## 5. Komponen Manajemen Media/File
### Spatie Media Library
- **Fungsi**: Spatie Media Library adalah package Laravel khusus untuk mengelola file upload
- **Implementasi**:
  - Menyimpan PDF materi dan tugas siswa
  - Generate thumbnail untuk gambar modul
  - Mengorganisir file per mata kuliah
---
