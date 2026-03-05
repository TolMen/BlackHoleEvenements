// ========== ACCORDÉON DES GROUPES DE FILTRES ==========

document.querySelectorAll(".filter-header").forEach((header) => {
    header.addEventListener("click", () => {
        const group = header.parentElement;
        group.classList.toggle("open");
    });
});

// ========== VARIABLES GLOBALES (utilisées aussi par filterReset.js / searchLieu.js) ==========

const checkboxes = document.querySelectorAll(".filter-checkbox");
const noResults = document.getElementById("no-results");

// ========== ÉCOUTEURS DE CHANGEMENT ==========

checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", filterPhotos);
});

// ========== FONCTION PRINCIPALE DE FILTRAGE ==========

function filterPhotos() {
    const filters = { service: [], theme: [], lieux: [] };

    checkboxes.forEach((cb) => {
        if (cb.checked) {
            const group = cb.closest(".filter-group").dataset.filter;
            filters[group].push(cb.value);
        }
    });

    // Délègue le rendu à galleryGestion.js
    if (window.applyGalleryFilters) {
        window.applyGalleryFilters(filters);
    }
}
