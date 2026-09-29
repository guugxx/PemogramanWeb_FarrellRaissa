<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$nama = trim($_POST['nama'] ?? '');
$noPenyewa = trim($_POST['no_penyewa'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($noPenyewa === '') {
    $errors[] = "No. Penyewa wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO penyewa (nama, no_penyewa, alamat, no_hp) VALUES (:nama, :no_penyewa, :alamat, :no_hp)'
    );
    $stmt->execute([
        'nama' => $nama,
        'no_penyewa' => $noPenyewa,
        'alamat' => $alamat,
        'no_hp' => $noHp,
    ]);
} catch (PDOException $e) {
    $pesan = $e->getCode() === '23505'
        ? 'Nomor penyewa sudah terdaftar.'
        : 'Data penyewa gagal disimpan. Periksa koneksi dan tabel database.';
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => $pesan];
    header('Location: tambah.php');
    exit;
}

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Penyewa berhasil ditambahkan.'];
header('Location: list.php');
exit;
