// ===== Hamburger menu (JS-driven) =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

// ===== Konfirmasi hapus =====
// Konfirmasi dilakukan saat form hapus dikirim agar request bisa dibatalkan.
function initHapusConfirm() {
    document.addEventListener("submit", function (e) {
        const form = e.target;
        if (!form.classList.contains("form-hapus")) return;

        const row = form.closest("tr");
        const nama = row ? row.querySelector("td")?.textContent : "data ini";
        const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
        if (!yakin) e.preventDefault();
    });
}

// ===== Filter/pencarian tabel real-time =====
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            const teks = row.textContent.toLowerCase();
            row.style.display = teks.includes(keyword) ? "" : "none";
        });
    });
}

// ===== Validasi form (client-side) =====
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        const nama = form.querySelector("[name='nama']");
        if (nama && nama.value.trim() === "") {
            tampilkanError(nama, "Field ini wajib diisi.");
            valid = false;
        } else if (nama) {
            hapusError(nama);
        }

        const kategori = form.querySelector("[name='kategori']");
        if (kategori && kategori.value.trim() === "") {
            tampilkanError(kategori, "Kategori wajib diisi.");
            valid = false;
        } else if (kategori) {
            hapusError(kategori);
        }

        const kondisi = form.querySelector("[name='kondisi']");
        if (kondisi && !["Baik", "Rusak Ringan", "Rusak Berat"].includes(kondisi.value)) {
            tampilkanError(kondisi, "Kondisi alat tidak valid.");
            valid = false;
        } else if (kondisi) {
            hapusError(kondisi);
        }

        const noPenyewa = form.querySelector("[name='no_penyewa']");
        if (noPenyewa && noPenyewa.value.trim() === "") {
            tampilkanError(noPenyewa, "No. Penyewa wajib diisi.");
            valid = false;
        } else if (noPenyewa) {
            hapusError(noPenyewa);
        }

        const stok = form.querySelector("[name='stok']");
        if (stok) {
            const nilai = stok.value.trim() === "" ? NaN : Number(stok.value);
            if (!Number.isInteger(nilai) || nilai < 0) {
                tampilkanError(stok, "Stok harus berupa bilangan bulat non-negatif.");
                valid = false;
            } else {
                hapusError(stok);
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});
