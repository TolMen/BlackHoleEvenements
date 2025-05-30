document.addEventListener("DOMContentLoaded", () => {
    const legalItems = document.querySelectorAll(".legal-item");

    legalItems.forEach((item) => {
        item.addEventListener("click", () => {
            const isExpanded = item.getAttribute("aria-expanded") === "true";

            legalItems.forEach((el) => {
                el.setAttribute("aria-expanded", "false");
                document.getElementById(
                    el.getAttribute("aria-controls")
                ).style.maxHeight = "0";
                el.querySelector(".legal-icon").classList.replace(
                    "fa-minus",
                    "fa-plus"
                );
            });

            if (!isExpanded) {
                item.setAttribute("aria-expanded", "true");
                const answer = document.getElementById(
                    item.getAttribute("aria-controls")
                );
                answer.style.maxHeight = answer.scrollHeight + "px";
                item.querySelector(".legal-icon").classList.replace(
                    "fa-plus",
                    "fa-minus"
                );
            }
        });
    });

    const firstItem = legalItems[0];
    if (firstItem) {
        firstItem.setAttribute("aria-expanded", "true");
        const answer = document.getElementById(
            firstItem.getAttribute("aria-controls")
        );
        answer.style.maxHeight = answer.scrollHeight + "px";
        firstItem
            .querySelector(".legal-icon")
            .classList.replace("fa-plus", "fa-minus");
    }
});
