/**
 * Fungsi untuk mengaktifkan dan menonaktifkan tampilan teks penuh pada kartu berita.
 * Fungsi ini bekerja berdasarkan penambahan/penghapusan kelas 'expanded'
 * yang didefinisikan di CSS (style.css)
 */
function toggleReadMore(paragrafId, linkElement) {
  // 1. Ambil elemen paragraf dan elemen span teks penuh
  const paragraf = document.getElementById(paragrafId);
  const fullTextContent = paragraf.querySelector(".full-text-content");
  const spanText = linkElement.querySelector("span");

  if (paragraf.classList.contains("expanded")) {
    // KONDISI: Teks sedang dalam mode penuh (expanded)

    // 1. Hapus kelas 'expanded' (CSS akan memotong teks menjadi 3 baris)
    paragraf.classList.remove("expanded");

    // 2. Sembunyikan konten tambahan
    fullTextContent.style.display = "none";

    // 3. Ubah tombol kembali
    spanText.textContent = "Baca Selengkapnya";
    linkElement.querySelector("i").className = "ri-arrow-right-line";
  } else {
    // KONDISI: Teks sedang dalam mode terpotong (truncate)

    // 1. Tambahkan kelas 'expanded' (CSS akan menampilkan semua teks)
    paragraf.classList.add("expanded");

    // 2. Tampilkan konten tambahan
    fullTextContent.style.display = "inline";

    // 3. Ubah tombol
    spanText.textContent = "Sembunyikan";
    linkElement.querySelector("i").className = "ri-arrow-up-line";
  }
}

/* ============================================================
   FUNGSI TAMBAHAN UNTUK TOMBOL LOGIN
   ============================================================ */

// Ambil tombol login di navbar
const loginButton = document.querySelector(".btn-login");

// Pastikan tombol ada sebelum memberi event listener
if (loginButton) {
  loginButton.addEventListener("click", function (event) {
    event.preventDefault(); // cegah aksi default <a> agar bisa diarahkan manual

    // Arahkan ke halaman login
    window.location.href = "login.html";
  });
}
