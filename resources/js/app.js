import "./bootstrap";
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    // tombol dengan atribut data-theme-toggle
    document.querySelectorAll("[data-theme-toggle]").forEach((btn) => {
        btn.addEventListener("click", () => {
            const root = document.documentElement;
            const dark = !root.classList.contains("dark"); // akan berpindah ke...
            root.classList.toggle("dark", dark);
            localStorage.setItem("theme", dark ? "dark" : "light");
        });
    });

    // Jika user belum memilih, biarkan selalu LIGHT (abaikan preferensi sistem)
    // Kalau mau mengikuti sistem saat belum memilih, hapus blok berikut.
    if (!localStorage.getItem("theme")) {
        document.documentElement.classList.remove("dark");
    }
});
