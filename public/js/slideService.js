const slide = document.querySelector(".slide");
const nextBtn = document.querySelector(".next");
const prevBtn = document.querySelector(".prev");

nextBtn.addEventListener("click", () => {
    const items = slide.querySelectorAll(".item");
    if (items.length > 1) {
        slide.appendChild(items[0]);
        setTimeout(updateTextFromActiveSlide, 300);
    }
});

prevBtn.addEventListener("click", () => {
    const items = slide.querySelectorAll(".item");
    if (items.length > 1) {
        slide.prepend(items[items.length - 1]);
        setTimeout(updateTextFromActiveSlide, 300);
    }
});
