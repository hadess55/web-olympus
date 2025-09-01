import "./bootstrap";
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[data-theme-toggle]").forEach((btn) => {
        btn.addEventListener("click", () => {
            const root = document.documentElement;
            const willBeDark = !root.classList.contains("dark");
            root.classList.toggle("dark", willBeDark);
            localStorage.setItem("theme", willBeDark ? "dark" : "light");
        });
    });
});
