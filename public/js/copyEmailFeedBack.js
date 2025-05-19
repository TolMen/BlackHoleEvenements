// Confirmation email copié
document.getElementById("copyEmail").addEventListener("click", function (e) {
    e.preventDefault();
    const email = this.getAttribute("data-email");
    navigator.clipboard.writeText(email).then(function () {
        const msg = document.getElementById("copyMessage");
        msg.style.display = "block";
        setTimeout(() => {
            msg.style.display = "none";
        }, 2000);
    });
});
