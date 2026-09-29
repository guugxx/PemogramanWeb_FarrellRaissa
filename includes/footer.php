    </main>

    <footer>
        <p>&copy; 2026 Pinjam ID &mdash; Farrell &amp; Raissa</p>
    </footer>
    <script src="<?php echo $base; ?>assets/js/app.js"></script>
    <?php if (!empty($extra_scripts)): foreach ($extra_scripts as $src): ?>
    <script src="<?php echo htmlspecialchars($src); ?>"></script>
    <?php endforeach; endif; ?>
</body>
</html>
