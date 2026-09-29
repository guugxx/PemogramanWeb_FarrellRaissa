<?php
$page_title = "Beranda";
require __DIR__ . '/includes/koneksi.php';
$totalAlat = (int) $pdo->query('SELECT COUNT(*) FROM alat')->fetchColumn();
$totalPenyewa = (int) $pdo->query('SELECT COUNT(*) FROM penyewa')->fetchColumn();
include __DIR__ . '/includes/header.php';
?>
        <section>
            <h2>Selamat Datang di Sistem Rental Alat</h2>
            <p>Aplikasi sederhana untuk mengelola data alat dan penyewa.</p>
        </section>

        <section>
            <h2>Ringkasan</h2>
            <article>
                <h3>Total Alat</h3>
                <p><?php echo $totalAlat; ?></p>
            </article>
            <article>
                <h3>Total Penyewa</h3>
                <p><?php echo $totalPenyewa; ?></p>
            </article>
            <article>
                <h3>Sedang Disewa</h3>
                <p>0</p>
            </article>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
