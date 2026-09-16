// Mengambil & menampilkan Daftar Penyewa secara asinkron dari data/anggota.json
async function muatDaftarPenyewa() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 600));

        const res = await fetch("../data/anggota.json");
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }
        const daftarPenyewa = await res.json();

        daftarPenyewa.forEach(function (penyewa) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + penyewa.no_anggota + "</td>" +
                "<td>" + penyewa.nama + "</td>" +
                "<td>" + penyewa.alamat + "</td>" +
                "<td>" + penyewa.no_hp + "</td>" +
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

document.addEventListener("DOMContentLoaded", muatDaftarPenyewa);