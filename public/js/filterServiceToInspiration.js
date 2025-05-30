const urlParams = new URLSearchParams(window.location.search);
const serviceParam = urlParams.get("service");

if (serviceParam) {
    const checkboxToCheck = [...checkboxes].find(
        (cb) => cb.value === serviceParam
    );
    if (checkboxToCheck) {
        checkboxToCheck.checked = true;
        filterPhotos();
    }
}
