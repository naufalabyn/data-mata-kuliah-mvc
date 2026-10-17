CREATE DATABASE IF NOT EXISTS data_mata_kuliah
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE data_mata_kuliah;

CREATE TABLE IF NOT EXISTS mata_kuliah (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_mk VARCHAR(20) NOT NULL UNIQUE,
    nama_mk VARCHAR(100) NOT NULL,
    sks TINYINT UNSIGNED NOT NULL,
    semester TINYINT UNSIGNED NOT NULL,
    program_studi VARCHAR(100) NOT NULL,
    dosen_pengampu VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO mata_kuliah
(kode_mk, nama_mk, sks, semester, program_studi, dosen_pengampu)
VALUES
('SI201', 'Basis Data', 3, 2, 'Sistem Informasi', 'Dr. Andi Pratama'),
('SI202', 'Pemrograman Web', 3, 2, 'Sistem Informasi', 'Budi Santoso'),
('SI203', 'Analisis Proses Bisnis', 2, 2, 'Sistem Informasi', 'Citra Lestari');
