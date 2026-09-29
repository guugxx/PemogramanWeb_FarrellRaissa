<?php
session_start();

$nama = trim($_POST['nama'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$kondisi = trim($_POST['kondisi'] ?? '');
$stok = $_POST['stok'] ?? '';

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
if (!is_numeric($stok) || $stok < 0) {
    $errors[] = "Stok tidak boleh negatif.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

if (!isset($_SESSION['alat'])) {
    $_SESSION['alat'] = [];
}

$_SESSION['alat'][] = [
    'nama' => $nama,
    'kategori' => $kategori,
    'kondisi' => $kondisi,
    'stok' => (int) $stok,
];

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Alat berhasil ditambahkan.'];
header('Location: list.php');
exit;
