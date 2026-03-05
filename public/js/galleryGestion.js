document.addEventListener("DOMContentLoaded", function () {
    const gallery = document.getElementById("gallery");
    const modalImage = document.getElementById("modalImage");
    const noResults = document.getElementById("no-results");

    // ========== CORRESPONDANCE CLÉS JSON / FILTRES DOM ==========

    const keyMap = {
        service: "filtres_services",
        theme: "filtres_themes",
        lieux: "filtres_lieux",
    };

    // ========== FILTRAGE ==========

    window.applyGalleryFilters = function (filters) {
        // Filtrage des données JSON
        const filtered = (window.galleryData || []).filter((img) => {
            return Object.keys(filters).every((group) => {
                if (filters[group].length === 0) return true;
                const dataVal = img[keyMap[group]] || "";
                const vals = dataVal.split(",").map((v) => v.trim());
                return filters[group].some((f) => vals.includes(f));
            });
        });

        // Réinitialiser la galerie
        gallery.innerHTML = "";
        noResults.classList.add("hidden");

        if (filtered.length === 0) {
            noResults.classList.remove("hidden");
            return;
        }

        // Affichage des skeletons pendant la construction du DOM
        filtered.forEach(() => {
            const sk = document.createElement("div");
            sk.className = "skeleton-card";
            gallery.appendChild(sk);
        });

        // Construction des vraies cartes dans le prochain tick
        // Les skeletons s'affichent brièvement, puis l'IntersectionObserver
        // prend le relais pour charger chaque image à la demande
        requestAnimationFrame(() => {
            gallery
                .querySelectorAll(".skeleton-card")
                .forEach((sk) => sk.remove());

            filtered.forEach((img) => {
                const card = buildImageCard(img);
                gallery.appendChild(card);
                imageObserver.observe(card.querySelector(".photo"));
            });
        });
    };

    // ========== LAZY LOAD DES IMAGES ==========

    const imageObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.lazySrc) {
                        img.src = img.dataset.lazySrc;
                        img.onload = () => {
                            img.classList.remove("photo-loading");
                            img.classList.add("photo-loaded");
                        };
                        img.onerror = () => {
                            // Fallback vers l'image originale si le thumbnail est manquant
                            if (img.src !== img.dataset.fullSrc) {
                                img.src = img.dataset.fullSrc;
                                img.onload = () => {
                                    img.classList.remove("photo-loading");
                                    img.classList.add("photo-loaded");
                                };
                            }
                        };
                        imageObserver.unobserve(img);
                    }
                }
            });
        },
        { rootMargin: "150px" },
    );

    // ========== CONSTRUCTION D'UNE CARTE IMAGE ==========

    function buildImageCard(img) {
        const wrapper = document.createElement("div");
        wrapper.className = "photo-wrapper position-relative";

        // Boutons admin
        if (window.isAdmin) {
            const deleteLink = document.createElement("a");
            deleteLink.href = `../../model/ImageModel/deleteImageModel.php?id=${img.id}`;
            deleteLink.className = "delete-badge";
            deleteLink.title = "Supprimer l'image";
            deleteLink.setAttribute("onclick", "event.stopPropagation();");
            deleteLink.innerHTML =
                '<i class="fa-solid fa-trash" style="color: red;"></i>';
            wrapper.appendChild(deleteLink);

            if (img.tag !== "imgSectionService") {
                const tagBtn = document.createElement("button");
                tagBtn.className = "tagService-badge";
                tagBtn.title = "Définir comme image de section";
                tagBtn.dataset.id = img.id;
                tagBtn.dataset.service = img.filtres_services || "";
                tagBtn.innerHTML =
                    '<i class="fa-solid fa-thumbtack" style="color: black;"></i>';
                tagBtn.addEventListener("click", handleTagService);
                wrapper.appendChild(tagBtn);
            }
        }

        // Élément image
        const imgEl = document.createElement("img");

        // Utilisation du thumbnail si disponible, sinon image originale
        const thumbSrc = img.chemin_thumb
            ? `../../../public/assets/img/${img.chemin_thumb}`
            : `../../../public/assets/img/${img.chemin_img}`;

        const fullSrc = `../../../public/assets/img/${img.chemin_img}`;

        imgEl.className = "photo photo-loading";
        imgEl.alt = img.alt || "";
        imgEl.dataset.id = img.id;
        imgEl.dataset.service = img.filtres_services || "";
        imgEl.dataset.theme = img.filtres_themes || "";
        imgEl.dataset.lieux = img.filtres_lieux || "";
        imgEl.dataset.lazySrc = thumbSrc;
        imgEl.dataset.fullSrc = fullSrc;
        imgEl.setAttribute("data-bs-toggle", "modal");
        imgEl.setAttribute("data-bs-target", "#imageModal");

        // Clic → affiche l'image full dans la modale
        imgEl.addEventListener("click", function () {
            modalImage.src = this.dataset.fullSrc;
            modalImage.alt = this.alt;
        });

        wrapper.appendChild(imgEl);
        return wrapper;
    }

    // ========== GESTION TAG SERVICE (admin) ==========

    function handleTagService(e) {
        e.preventDefault();
        e.stopPropagation();

        const imageId = this.dataset.id;
        const service = this.dataset.service;

        fetch("../../model/ImageModel/setSectionImage.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ imageId, service }),
        })
            .then((r) => r.json())
            .then((data) => {
                if (data.success) {
                    alert("Image définie comme image de section !");
                    location.reload();
                } else {
                    alert("Erreur : " + data.message);
                }
            })
            .catch((err) => {
                console.error(err);
                alert("Erreur serveur");
            });
    }

    // ========== INITIALISATION ==========

    // Chargement initial sans filtre actif
    window.applyGalleryFilters({ service: [], theme: [], lieux: [] });
});
