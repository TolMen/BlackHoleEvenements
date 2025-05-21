document.querySelectorAll(".gallery .photo").forEach((img) => {
    img.addEventListener("click", () => {
        const modalImg = document.getElementById("modalImage");
        modalImg.src = img.src;
        modalImg.alt = img.alt || "Image agrandie";
    });
});
