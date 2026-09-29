<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$id = $_POST['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$kondisi = trim($_POST['kondisi'] ?? '');
$stok = filter_var($_POST['stok'] ?? '', FILTER_VALIDATE_INT);
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
if ($stok === false || $stok < 0) {
    $errors[] = "Stok harus berupa bilangan bulat non-negatif.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE alat SET nama = :nama, kategori = :kategori, kondisi = :kondisi,
     stok = :stok WHERE id = :id"
);
$stmt->execute([
    'nama' => $nama,
    'kategori' => $kategori,
    'kondisi' => $kondisi,
    'stok' => $stok,
    'id' => $id,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Alat berhasil diperbarui.'];
header('Location: list.php');
exit;