# Aplikasi Data Mata Kuliah - PHP Native MVC

Aplikasi CRUD Data Mata Kuliah untuk penugasan individu praktikum MVC PHP Native dengan Git.

## Fitur
- Read: menampilkan daftar mata kuliah.
- Create: menambahkan data mata kuliah.
- Update: mengubah data mata kuliah.
- Delete: menghapus data melalui form POST dan konfirmasi.
- Validasi field wajib, SKS, dan semester.
- PDO, prepared statement, escaping output dengan `htmlspecialchars()`.
- Pesan berhasil/gagal setelah operasi.

## Atribut
Kode MK, nama mata kuliah, SKS, semester, program studi, dan dosen pengampu.

## Kebutuhan
- PHP 8.0 atau lebih baru dengan ekstensi PDO MySQL.
- MySQL/MariaDB.
- XAMPP atau Laragon.
- Git.

## Struktur MVC
- `app/models/`: query dan operasi database.
- `app/controllers/`: validasi alur, memanggil model, dan memilih view.
- `app/views/`: antarmuka HTML.
- `config/`: koneksi database dengan PDO.
- `database/`: skrip SQL.
- `public/`: entry point dan routing.

## Instalasi menggunakan XAMPP
1. Salin folder proyek ke `C:\\xampp\\htdocs\\data-mata-kuliah-mvc`.
2. Jalankan Apache dan MySQL dari XAMPP.
3. Buka phpMyAdmin, pilih Import, lalu impor `database/mata_kuliah.sql`.
4. Periksa username/password database pada `config/database.php` (konfigurasi awal: root tanpa password).
5. Buka `http://localhost/data-mata-kuliah-mvc/public/index.php`.

## Pengujian
1. Read: pastikan data contoh muncul.
2. Create: tambah satu mata kuliah lalu pastikan muncul di daftar.
3. Update: ubah salah satu nilai dan pastikan perubahan tersimpan.
4. Delete: hapus data uji dan pastikan data tidak muncul lagi.
5. Validasi: coba mengirim form dengan field kosong atau SKS di luar 1–6.
6. Kode mata kuliah harus unik.

## Histori Git
Jalankan `git log --oneline --graph --decorate` untuk melihat histori commit. Lakukan commit bertahap sesuai tahapan pengembangan, bukan satu commit besar.
