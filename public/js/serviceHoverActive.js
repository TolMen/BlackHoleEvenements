const options = document.querySelectorAll(".option");
let lastHovered = options[0];

// Initialise la première comme active
options.forEach((opt) => opt.classList.remove("active"));
lastHovered.classList.add("active");

options.forEach((option) => {
    option.addEventListener("mouseenter", () => {
        options.forEach((opt) => opt.classList.remove("active"));
        option.classList.add("active");
        lastHovered = option;
    });
});

// Garde le dernier survolé actif
document.querySelector(".options").addEventListener("mouseleave", () => {
    options.forEach((opt) => opt.classList.remove("active"));
    lastHovered.classList.add("active");
});
