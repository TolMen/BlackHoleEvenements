const resetBtn = document.getElementById("resetFiltersBtn");

resetBtn.addEventListener("click", () => {
    // Décocher tous les filtres
    checkboxes.forEach((cb) => (cb.checked = false));

    // Afficher toutes les photos (enlever la classe 'hidden')
    photos.forEach((photo) => photo.classList.remove("hidden"));

    // Cacher le message "aucun résultat"
    noResults.classList.add("hidden");
});
