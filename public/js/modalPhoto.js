const modal = document.getElementById("modal");
const modalImg = document.getElementById("modal-img");

photos.forEach((photo) => {
    photo.addEventListener("click", () => {
        modalImg.src = photo.src;
        modalImg.alt = photo.alt;
        modal.classList.add("active");
    });
});

modal.addEventListener("click", (e) => {
    if (e.target === modal) {
        modal.classList.remove("active");
        modalImg.src = "";
        modalImg.alt = "";
    }
});
