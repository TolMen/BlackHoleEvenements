document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".show-popup");
    const popup = document.getElementById("popup");
    const popupMessage = document.getElementById("popup-message");
    const closeBtn = document.getElementById("closePopup");

    cards.forEach((card) => {
        card.addEventListener("click", () => {
            const id = card.getAttribute("data-id");
            const name = card.getAttribute("data-nom");
            const email = card.getAttribute("data-email");
            const objet = card.getAttribute("data-objet");
            const message = card.getAttribute("data-message");
            const isRead = card.getAttribute("data-read") === "1";
            const date = card.getAttribute("data-date");

            popupMessage.innerHTML = `
                <strong>De :</strong> ${name} (${email})<br>
                <strong>Objet :</strong> ${objet}<br>
                <strong>Date :</strong> ${date}<br>
                <strong>Statut :</strong> ${
                    isRead
                        ? '<span style="color: green;">Lu</span>'
                        : '<span style="color: red;">Non lu</span>'
                }<br><br>
                ${message.replace(/\n/g, "<br>")}
            `;

            closeBtn.setAttribute("data-id", id);

            popup.classList.add("show");
        });
    });

    closeBtn.addEventListener("click", () => {
        const id = closeBtn.getAttribute("data-id");
        if (!id) {
            popup.classList.remove("show");
            return;
        }

        // Trouver la carte correspondante pour vérifier si déjà lu
        const card = document.querySelector(`.message-card[data-id="${id}"]`);
        const isRead = card && card.getAttribute("data-read") === "1";

        if (isRead) {
            // Message déjà lu, on ferme la popup sans requête inutile
            popup.classList.remove("show");
            return;
        }

        // Sinon on envoie la requête pour marquer comme lu
        fetch("../../control/AdminControl/markAsReadControl.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "id=" + encodeURIComponent(id),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    if (card) {
                        card.classList.remove("unread");
                        card.setAttribute("data-read", "1");
                        const statusText = card.querySelector(".status small");
                        if (statusText) {
                            statusText.textContent = "Lu";
                            statusText.classList.remove("text-danger");
                            statusText.classList.add("text-success");
                        }
                    }
                    popup.classList.remove("show");
                } else {
                    console.error("Erreur lors de la mise à jour:", data.error);
                    popup.classList.remove("show");
                }
            })
            .catch((error) => {
                console.error("Erreur AJAX :", error);
                popup.classList.remove("show");
            });
    });    
});
