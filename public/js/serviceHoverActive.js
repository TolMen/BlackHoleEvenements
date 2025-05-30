const options = document.querySelectorAll(".option");
let lastHovered = options[0];

options.forEach((opt) => opt.classList.remove("active"));
lastHovered.classList.add("active");

options.forEach((option) => {
    option.addEventListener("mouseenter", () => {
        options.forEach((opt) => opt.classList.remove("active"));
        option.classList.add("active");
        lastHovered = option;
    });
});

document.querySelector(".options").addEventListener("mouseleave", () => {
    options.forEach((opt) => opt.classList.remove("active"));
    lastHovered.classList.add("active");
});
