// Applique le filtre service issu du paramètre URL (?service=xxx)
// Enveloppé dans DOMContentLoaded pour s'assurer que galleryGestion.js est prêt
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const serviceParam = urlParams.get("service");

    if (serviceParam) {
        const checkboxToCheck = [...checkboxes].find(
            (cb) => cb.value === serviceParam,
        );
        if (checkboxToCheck) {
            checkboxToCheck.checked = true;
            filterPhotos();
        }
    }
});
