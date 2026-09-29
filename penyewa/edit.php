<?php
$page_title = "Edit Penyewa";
require __DIR__ . '/../includes/koneksi.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM penyewa WHERE id = :id");
$stmt->execute(['id' => $id]);
$penyewa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$penyewa) {
    header('Location: list.php');
    exit;
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
include __DIR__ . '/../includes/header.php';
?>
        <section>
            <h2>Edit Penyewa</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
            <?php endif; ?>

            <form id="form-tambah" method="post" action="proses_edit.php">
                <input type="hidden" name="id" value="<?php echo (int) $penyewa['id']; ?>">
                <p>
                    <label for="nama">Nama</label><br>
                    <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($penyewa['nama']); ?>" required>
                </p>
                <p>
                    <label for="no_penyewa">No. Penyewa</label><br>
                    <input type="text" id="no_penyewa" name="no_penyewa" value="<?php echo htmlspecialchars($penyewa['no_penyewa']); ?>" required>
                </p>
                <p>
                    <label for="alamat">Alamat</label><br>
                    <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($penyewa['alamat'] ?? ''); ?>">
                </p>
                <p>
                    <label for="no_hp">No. HP</label><br>
                    <input type="text" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($penyewa['no_hp'] ?? ''); ?>">
                </p>
                <p>
                    <button type="submit">Update</button>
                </p>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>