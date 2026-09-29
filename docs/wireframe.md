# Wireframe Pinjam ID

Layout dasar semua halaman: **Header (logo + navbar)** → **Main (section)** → **Footer**.
Navbar: Beranda | Daftar Alat | Tambah Alat | Daftar Penyewa | Tambah Penyewa
Pada layar ≤ 480px navbar disembunyikan dan dibuka lewat tombol hamburger (☰).

## 1. Beranda (`index.php`)
```
+--------------------------------------------------+
| Pinjam ID        Beranda | Alat | ... | Penyewa   |
+--------------------------------------------------+
|  +--------------------------------------------+  |
|  |   Selamat Datang di Sistem Rental Alat     |  |
|  |   Aplikasi sederhana untuk mengelola ...   |  |
|  +--------------------------------------------+  |
|  +--------------------------------------------+  |
|  |                 Ringkasan                  |  |
|  |  [Total Alat] [Total Penyewa] [Disewa]     |  |
|  +--------------------------------------------+  |
+--------------------------------------------------+
|            © 2026 Pinjam ID                      |
+--------------------------------------------------+
```

## 2. Daftar Alat / Daftar Penyewa (`list.php`)
```
+--------------------------------------------------+
| Header + Navbar                                  |
+--------------------------------------------------+
|  Daftar Alat                                     |
|  [ flash message (sukses/error) ]                |
|  Cari Nama Alat: [__________________]            |
|  +----------+----------+---------+------+------+ |
|  | Nama     | Kategori | Kondisi | Stok | Aksi | |
|  +----------+----------+---------+------+------+ |
|  | ...      | ...      | ...     | ...  |Edit/ | |
|  |          |          |         |      |Hapus | |
|  +----------+----------+---------+------+------+ |
+--------------------------------------------------+
| Footer                                           |
+--------------------------------------------------+
```
Daftar Penyewa: kolom No. Penyewa | Nama | Alamat | No. HP | Aksi.

## 3. Tambah Alat / Tambah Penyewa (`tambah.php`)
```
+--------------------------------------------------+
| Header + Navbar                                  |
+--------------------------------------------------+
|  Tambah Alat                                     |
|  [ flash message error ]                         |
|  Nama Alat  [______________]                     |
|  Kategori   [______________]                     |
|  Kondisi    [ Baik        v]                     |
|  Stok       [______________]                     |
|  [ Simpan ]  --POST--> proses_tambah.php         |
+--------------------------------------------------+
| Footer                                           |
+--------------------------------------------------+
```
Tambah Penyewa: Nama | No. Penyewa | Alamat | No. HP.

## Alur data
`tambah.php` --POST--> `proses_tambah.php` --validasi server--> simpan ke `$_SESSION`
--> flash message --> redirect ke `list.php` (sukses) atau kembali ke `tambah.php` (error).
