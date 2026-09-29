<?php
$page_title = "Daftar Penyewa";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarPenyewa = $_SESSION['penyewa'] ?? [];
?>
        <section>
            <h2>Daftar Penyewa</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
            <?php endif; ?>

            <div class="search-box">
                <label for="search-input">Cari Nama Penyewa</label>
                <input type="text" id="search-input" placeholder="Ketik nama penyewa...">
            </div>

            <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No. Penyewa</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarPenyewa)): ?>
                    <tr>
                        <td colspan="5">Belum ada data penyewa. Silakan tambah lewat menu "Tambah Penyewa".</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($daftarPenyewa as $penyewa): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($penyewa['no_anggota']); ?></td>
                            <td><?php echo htmlspecialchars($penyewa['nama']); ?></td>
                            <td><?php echo htmlspecialchars($penyewa['alamat']); ?></td>
                            <td><?php echo htmlspecialchars($penyewa['no_hp']); ?></td>
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
