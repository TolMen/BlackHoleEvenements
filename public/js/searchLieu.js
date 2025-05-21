const lieuxInput = document.getElementById("lieuxSearch");
const lieuxSuggestions = document.getElementById("lieuxSuggestions");
const lieuxCheckboxes = document.querySelectorAll(
    '[data-filter="lieux"] .filter-options input[type="checkbox"]'
);

lieuxInput.addEventListener("input", () => {
    const query = lieuxInput.value.toLowerCase();
    lieuxSuggestions.innerHTML = "";

    if (!query) return;

    let found = false;

    lieuxCheckboxes.forEach((cb) => {
        const label = cb.parentElement.textContent.trim().toLowerCase();
        if (label.includes(query)) {
            found = true;

            const suggestion = document.createElement("div");
            suggestion.textContent =
                label.charAt(0).toUpperCase() + label.slice(1);
            suggestion.style.cursor = "pointer";
            suggestion.style.padding = "3px 5px";
            suggestion.style.borderBottom =
                "1px solid var(--color-gray-border)";

            suggestion.addEventListener("click", () => {

                lieuxCheckboxes.forEach((c) => (c.checked = false));

                cb.checked = true;

                lieuxInput.value = "";
                lieuxSuggestions.innerHTML = "";
                filterPhotos();
            });

            lieuxSuggestions.appendChild(suggestion);
        }
    });

    if (!found) {
        const noResult = document.createElement("div");
        noResult.textContent = "Aucun résultat";
        noResult.style.padding = "5px 10px";
        noResult.style.color = "var(--color-gray-border)";
        lieuxSuggestions.appendChild(noResult);
    }
});

document.addEventListener("click", (e) => {
    if (
        !e.target.closest("#lieuxSearch") &&
        !e.target.closest("#lieuxSuggestions")
    ) {
        lieuxSuggestions.innerHTML = "";
    }
});

lieuxInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
        e.preventDefault();
        const query = lieuxInput.value.toLowerCase();

        for (let cb of lieuxCheckboxes) {
            const label = cb.parentElement.textContent.trim().toLowerCase();
            if (label.includes(query)) {
                lieuxCheckboxes.forEach((c) => (c.checked = false));
                cb.checked = true;
                lieuxInput.value = "";
                lieuxSuggestions.innerHTML = "";
                filterPhotos();
                break;
            }
        }
    }
});
