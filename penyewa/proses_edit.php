<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$id = $_POST['id'] ?? null;
$nama = trim($_POST['nama'] ?? '');
$noPenyewa = trim($_POST['no_penyewa'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

if (!$id) {
    header('Location: list.php');
    exit;
}

$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($noPenyewa === '') {
    $errors[] = "No. Penyewa wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE penyewa SET nama = :nama, no_penyewa = :no_penyewa,
     alamat = :alamat, no_hp = :no_hp WHERE id = :id"
);
$stmt->execute([
    'nama' => $nama,
    'no_penyewa' => $noPenyewa,
    'alamat' => $alamat,
    'no_hp' => $noHp,
    'id' => $id,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Penyewa berhasil diperbarui.'];
header('Location: list.php');
exit;