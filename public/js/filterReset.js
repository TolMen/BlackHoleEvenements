const resetBtn = document.getElementById("resetFiltersBtn");

resetBtn.addEventListener("click", () => {
    checkboxes.forEach((cb) => (cb.checked = false));

    photos.forEach((photo) => photo.classList.remove("hidden"));

    noResults.classList.add("hidden");
});
