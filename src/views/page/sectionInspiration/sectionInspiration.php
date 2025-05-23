<!-- Modal pour agrandir l'image -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background-color: transparent; border: none; box-shadow: none;">
            <div class="modal-body text-center p-0">
                <img id="modalImage" src="" alt="Image agrandie" style="width: 100%; height: auto; object-fit: contain;" />
            </div>
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
</div>

<section class="main-container">

    <!-- SIDEBAR avec TITRE + FILTRES -->
    <div class="sidebar">
        <!-- TITRE -->
        <div class="faq-section">
            <h2 class="section-title">Inspiration</h2>
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
                        <input type="checkbox" value="<?= htmlspecialchars($service['valeur']) ?>" class="filter-checkbox">
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

    <!-- GALERIE -->
    <div class="gallery">
        <?php foreach ($imagesGallery as $img): ?>
            <img
                src="../../../public/assets/img/<?= htmlspecialchars($img['chemin_img']) ?>"
                alt="<?= htmlspecialchars($img['alt']) ?>"
                class="photo"
                data-service="<?= htmlspecialchars($img['filtres_services'] ?? '') ?>"
                data-theme="<?= htmlspecialchars($img['filtres_themes'] ?? '') ?>"
                data-lieux="<?= htmlspecialchars($img['filtres_lieux'] ?? '') ?>"
                data-bs-toggle="modal"
                data-bs-target="#imageModal" />
        <?php endforeach; ?>

        <!-- Message si aucun résultat -->
        <div id="no-results" class="hidden">
            Aucun résultat ne correspond à vos filtres...
        </div>
    </div>

</section>