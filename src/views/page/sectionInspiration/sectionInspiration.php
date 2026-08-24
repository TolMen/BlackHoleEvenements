<?php
// Injection des données galerie en JSON pour galleryGestion.js
// Le PHP génère les métadonnées uniquement, sans balises <img> (chargement côté client)
$galleryDataJson = json_encode(array_values($imagesGallery), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
$isAdmin = (isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'admin') ? 'true' : 'false';
?>

<section class="main-container">
    <!-- SIDEBAR avec TITRE + FILTRES -->
    <div class="sidebar">
        <!-- TITRE -->
        <div class="faq-section">
            <h1 class="section-title">Inspiration</h1>
            <hr class="title-separator">
        </div>

        <!-- Reset -->
        <div class="filter-reset-container">
            <button id="resetFiltersBtn" class="resetFilter" title="Réinitialiser les filtres">Retirer les filtres</button>
        </div>

        <!-- Filtres : Service -->
        <div class="filter-group open" data-filter="service">
            <div class="filter-header">Service</div>
            <div class="filter-options">
                <?php foreach ($services as $service): ?>
                    <label>
                        <input type="checkbox"
                            value="<?= htmlspecialchars($service['valeur']) ?>"
                            class="filter-checkbox"
                            <?= ($service['valeur'] === $selectedService) ? 'checked' : '' ?>>
                        <?= htmlspecialchars($service['nom']) ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Filtres : Thème -->
        <div class="filter-group" data-filter="theme">
            <div class="filter-header">Thème</div>
            <div class="filter-options">
                <?php foreach ($themes as $theme): ?>
                    <label>
                        <input type="checkbox" value="<?= htmlspecialchars($theme['valeur']) ?>" class="filter-checkbox">
                        <?= htmlspecialchars($theme['nom']) ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Filtres : Lieux -->
        <div class="filter-group" data-filter="lieux">
            <div class="filter-header">Lieux</div>
            <input type="text" id="lieuxSearch" placeholder="Rechercher un lieu">
            <div id="lieuxSuggestions"></div>
            <div class="filter-options" id="lieuxFilterList">
                <?php foreach ($lieux as $lieu): ?>
                    <label>
                        <input type="checkbox" value="<?= htmlspecialchars($lieu['valeur']) ?>" class="filter-checkbox">
                        <?= htmlspecialchars($lieu['nom']) ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- GALERIE — peuplée dynamiquement par galleryGestion.js -->
    <div class="gallery" id="gallery"></div>

</section>

<!-- Message si aucun résultat (géré par galleryGestion.js) -->
<div id="no-results" class="hidden no-results-msg">
    Aucun résultat ne correspond à vos filtres...
</div>

<!-- Modale personnalisée pour image -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.8);">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content border-0">
            <div class="modal-body d-flex justify-content-center align-items-center p-0" style="background-color: transparent; height: calc(100vh - 62px); margin: 0;">
                <img
                    id="modalImage"
                    src=""
                    alt="Image agrandie"
                    class="img-fluid"
                    style="max-width: 90vw; max-height: 90vh; object-fit: contain; cursor: pointer; margin: 0; display: block;"
                    data-bs-dismiss="modal">
            </div>
        </div>
    </div>
</div>

<!-- Données JSON de la galerie (métadonnées uniquement, sans octets d'image) -->
<script>
    window.galleryData = <?= $galleryDataJson ?>;
    window.isAdmin = <?= $isAdmin ?>;
</script>