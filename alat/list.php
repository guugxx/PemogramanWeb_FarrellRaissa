<?php
$page_title = "Daftar Alat";
require __DIR__ . '/../includes/koneksi.php';
$daftarAlat = $pdo->query('SELECT id, nama, kategori, kondisi, stok FROM alat ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Daftar Alat</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
            <?php endif; ?>

            <div class="search-box">
                <label for="search-input">Cari Nama Alat</label>
                <input type="text" id="search-input" placeholder="Ketik nama alat...">
            </div>

            <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Kondisi</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarAlat)): ?>
                    <tr>
                        <td colspan="5">Belum ada data alat. Silakan tambah lewat menu "Tambah Alat".</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($daftarAlat as $alat): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($alat['nama']); ?></td>
                            <td><?php echo htmlspecialchars($alat['kategori']); ?></td>
                            <td><?php echo htmlspecialchars($alat['kondisi']); ?></td>
                            <td><?php echo $alat['stok']; ?></td>
                            <td>
                                <button type="button">Edit</button>
                                <button type="button" class="btn-hapus">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
