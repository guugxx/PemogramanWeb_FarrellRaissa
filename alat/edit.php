<?php
$page_title = "Edit Alat";
require __DIR__ . '/../includes/koneksi.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM alat WHERE id = :id");
$stmt->execute(['id' => $id]);
$alat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$alat) {
    header('Location: list.php');
    exit;
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
include __DIR__ . '/../includes/header.php';
?>
        <section>
            <h2>Edit Alat</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
            <?php endif; ?>

            <form id="form-tambah" method="post" action="proses_edit.php">
                <input type="hidden" name="id" value="<?php echo (int) $alat['id']; ?>">
                <p>
                    <label for="nama">Nama Alat</label><br>
                    <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($alat['nama']); ?>" required>
                </p>
                <p>
                    <label for="kategori">Kategori</label><br>
                    <input type="text" id="kategori" name="kategori" value="<?php echo htmlspecialchars($alat['kategori']); ?>" required>
                </p>
                <p>
                    <label for="kondisi">Kondisi</label><br>
                    <select id="kondisi" name="kondisi" required>
                        <?php foreach (['Baik', 'Rusak Ringan', 'Rusak Berat'] as $kondisi): ?>
                            <option value="<?php echo htmlspecialchars($kondisi); ?>" <?php echo $alat['kondisi'] === $kondisi ? 'selected' : ''; ?>><?php echo htmlspecialchars($kondisi); ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <p>
                    <label for="stok">Stok</label><br>
                    <input type="number" id="stok" name="stok" min="0" step="1" value="<?php echo (int) $alat['stok']; ?>" required>
                </p>
                <p>
                    <button type="submit">Update</button>
                </p>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
