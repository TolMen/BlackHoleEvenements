// Accordéon filtres
document.querySelectorAll(".filter-header").forEach((header) => {
    header.addEventListener("click", () => {
        const group = header.parentElement;
        group.classList.toggle("open");
    });
});

const checkboxes = document.querySelectorAll(".filter-checkbox");
const photos = document.querySelectorAll(".photo:not(#no-results)");
const noResults = document.getElementById("no-results");

checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", filterPhotos);
});

function filterPhotos() {
    const filters = {
        service: [],
        theme: [],
        lieux: [],
    };

    checkboxes.forEach((cb) => {
        if (cb.checked) {
            const group = cb.closest(".filter-group").dataset.filter;
            filters[group].push(cb.value);
        }
    });

    let visibleCount = 0;

    photos.forEach((photo) => {
        const matches = Object.keys(filters).every((group) => {
            if (filters[group].length === 0) return true;
            // On split la valeur data-* en tableau (pour gérer plusieurs valeurs séparées par des virgules)
            const dataValues = photo.dataset[group]
                .split(",")
                .map((v) => v.trim());
            // On vérifie si au moins une valeur du filtre est présente dans les valeurs du data-*
            return filters[group].some((f) => dataValues.includes(f));
        });

        photo.classList.toggle("hidden", !matches);
        if (matches) visibleCount++;
    });

    noResults.classList.toggle("hidden", visibleCount !== 0);
}
