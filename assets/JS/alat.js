// Mengambil & menampilkan Daftar Alat secara asinkron dari data/alat.json
async function muatDaftarAlat() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 600));

        const res = await fetch("../data/alat.json");
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }
        const daftarAlat = await res.json();

        daftarAlat.forEach(function (alat) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + alat.nama + "</td>" +
                "<td>" + alat.kategori + "</td>" +
                "<td>" + alat.kondisi + "</td>" +
                "<td>" + alat.stok + "</td>" +
                "<td>" +
                "<button type=\"button\">Edit</button> " +
                "<button type=\"button\" class=\"btn-hapus\">Hapus</button>" +
                "</td>";
            tbody.appendChild(tr);
        });
    } catch (err) {
        tbody.innerHTML =
            "<tr><td colspan=\"5\">Gagal memuat data: " + err.message + "</td></tr>";
    } finally {
        loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarAlat);