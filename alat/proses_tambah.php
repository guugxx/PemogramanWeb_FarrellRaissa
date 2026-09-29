<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$nama = trim($_POST['nama'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$kondisi = trim($_POST['kondisi'] ?? '');
$stok = $_POST['stok'] ?? '';
$stokValid = filter_var($stok, FILTER_VALIDATE_INT);

// Validasi server-side — wajib ada meski sudah divalidasi JS,
// karena validasi client bisa dilewati (nonaktifkan JS / kirim request manual).
$kondisiValid = ['Baik', 'Rusak Ringan', 'Rusak Berat'];

$errors = [];
if ($nama === '') {
    $errors[] = "Nama alat wajib diisi.";
}
if ($kategori === '') {
    $errors[] = "Kategori wajib diisi.";
}
if (!in_array($kondisi, $kondisiValid, true)) {
    $errors[] = "Kondisi tidak valid.";
}
if ($stokValid === false || $stokValid < 0) {
    $errors[] = "Stok harus berupa bilangan bulat non-negatif.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO alat (nama, kategori, kondisi, stok) VALUES (:nama, :kategori, :kondisi, :stok)'
    );
    $stmt->execute([
        'nama' => $nama,
        'kategori' => $kategori,
        'kondisi' => $kondisi,
        'stok' => $stokValid,
    ]);
} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Data alat gagal disimpan. Periksa koneksi dan tabel database.'];
    header('Location: tambah.php');
    exit;
}

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Alat berhasil ditambahkan.'];
header('Location: list.php');
exit;
