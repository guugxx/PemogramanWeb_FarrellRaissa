-- Skema database rental alat (PostgreSQL)
-- Jalankan setelah membuat database, misal:
--   createdb Pinjam_id
--   psql -d Pinjam_id -f sql/01_Alat_Penyewa.sql

CREATE TABLE IF NOT EXISTS alat (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    kondisi VARCHAR(50) NOT NULL,
    stok INTEGER NOT NULL DEFAULT 0 CHECK (stok >= 0)
);

CREATE TABLE IF NOT EXISTS penyewa (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    no_penyewa VARCHAR(50) NOT NULL UNIQUE,
    alamat VARCHAR(255),
    no_hp VARCHAR(30)
);