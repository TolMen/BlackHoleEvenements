const resetBtn = document.getElementById("resetFiltersBtn");

resetBtn.addEventListener("click", () => {
    // Décocher toutes les cases
    checkboxes.forEach((cb) => (cb.checked = false));

    // Réinitialiser la galerie via galleryGestion.js
    if (window.applyGalleryFilters) {
        window.applyGalleryFilters({ service: [], theme: [], lieux: [] });
    }

    noResults.classList.add("hidden");
});
