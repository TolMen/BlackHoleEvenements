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

    <div class="main-container">

        <!-- SIDEBAR avec TITRE + FILTRES -->
        <div class="sidebar">

            <!-- TITRE dans la sidebar -->
            <div class="faq-section">
                <h2 class="section-title">Inspiration</h2>
                <hr class="title-separator">
            </div>

            <!-- Bouton Reset -->
            <div class="filter-reset-container">
                <button id="resetFiltersBtn" class="resetFilter" title="Réinitialiser les filtres">
                    <i class="fa fa-refresh" aria-hidden="true"></i>
                </button>
            </div>


            <!-- Filtres : Service -->
            <div class="filter-group open" data-filter="service">
                <div class="filter-header">Service</div>
                <div class="filter-options">
                    <label><input type="checkbox" value="photo" class="filter-checkbox">Photo</label><br>
                    <label><input type="checkbox" value="video" class="filter-checkbox">Vidéo</label><br>
                    <label><input type="checkbox" value="drone" class="filter-checkbox">Drone</label><br>
                    <label><input type="checkbox" value="montage" class="filter-checkbox">Montage</label><br>
                    <label><input type="checkbox" value="live" class="filter-checkbox">Live</label><br>
                    <label><input type="checkbox" value="studio" class="filter-checkbox">Studio</label><br>
                    <label><input type="checkbox" value="retouche" class="filter-checkbox">Retouche</label><br>
                    <label><input type="checkbox" value="reportage" class="filter-checkbox">Reportage</label>
                </div>
            </div>

            <!-- Filtres : Thème -->
            <div class="filter-group" data-filter="theme">
                <div class="filter-header">Thème</div>
                <div class="filter-options">
                    <label><input type="checkbox" value="mariage" class="filter-checkbox">Mariage</label><br>
                    <label><input type="checkbox" value="entreprise" class="filter-checkbox">Entreprise</label><br>
                    <label><input type="checkbox" value="evenement" class="filter-checkbox">Événement</label>
                </div>
            </div>

            <!-- Filtres : Lieux -->
            <div class="filter-group" data-filter="lieux">
                <div class="filter-header">Lieux</div>

                <!-- Barre de recherche -->
                <input type="text" id="lieuxSearch" placeholder="Rechercher un lieu">

                <!-- Suggestions dynamiques -->
                <div id="lieuxSuggestions"></div>

                <div class="filter-options">
                    <label><input type="checkbox" value="paris" class="filter-checkbox">Paris</label><br>
                    <label><input type="checkbox" value="lyon" class="filter-checkbox">Lyon</label><br>
                    <label><input type="checkbox" value="marseille" class="filter-checkbox">Marseille</label>
                </div>
            </div>

        </div>

        <!-- GALERIE -->
        <div class="gallery">
            <img src="../../../public/assets/img/imgHero/imgEclairageExterieur.jpeg" alt="Photo Mariage Paris" class="photo" data-service="photo,live" data-theme="mariage" data-lieux="paris" data-bs-toggle="modal" data-bs-target="#imageModal" />
            <img src="../../../public/assets/img/imgHero/imgMariageAubusson.jpeg" alt="Photo Mariage Paris" class="photo" data-service="live" data-theme="entreprise" data-lieux="lyon" data-bs-toggle="modal" data-bs-target="#imageModal" />
            <img src="../../../public/assets/img/imgHero/imgMariageClosFour.jpeg" alt="Photo Mariage Paris" class="photo" data-service="studio" data-theme="entreprise" data-lieux="paris" data-bs-toggle="modal" data-bs-target="#imageModal" />
            <img src="../../../public/assets/img/imgHero/imgMariageEbreuilDecoLumineuse.jpeg" alt="Photo Mariage Paris" class="photo" data-service="drone" data-theme="evenement" data-lieux="marseille" data-bs-toggle="modal" data-bs-target="#imageModal" />
            <img src="../../../public/assets/img/imgHero/imgMariageVichyDJ.jpeg" alt="Photo Mariage Paris" class="photo" data-service="photo" data-theme="mariage" data-lieux="marseille" data-bs-toggle="modal" data-bs-target="#imageModal" />
            <img src="../../../public/assets/img/imgHero/imgMariageVichyDJ.jpeg" alt="Photo Mariage Paris" class="photo" data-service="photo" data-theme="mariage" data-lieux="marseille" data-bs-toggle="modal" data-bs-target="#imageModal" />
            <img src="../../../public/assets/img/imgHero/imgMariageVichyDJ.jpeg" alt="Photo Mariage Paris" class="photo" data-service="photo" data-theme="mariage" data-lieux="marseille" data-bs-toggle="modal" data-bs-target="#imageModal" />

            <!-- Message si aucun résultat -->
            <div id="no-results" class="hidden">
                Aucun résultat ne correspond à vos filtres.
            </div>
        </div>

    </div>