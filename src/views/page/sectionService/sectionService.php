<section class="boxService">
    <!-- Titre de la page : masqué visuellement (le visuel porte déjà le message),
         mais présent pour les moteurs de recherche et les lecteurs d'écran. -->
    <h1 class="visually-hidden">Nos prestations audiovisuelles et événementielles</h1>

    <div class="slide">
        <?php foreach ($servicesForServicePage as $service): ?>
            <div class="item" style="background-image: url(<?= BASE_PATH ?>/public/assets/img/<?= $service['chemin_img'] ?>);">
                <div class="content">
                    <h2 class="name"><?= e($service['nom']) ?></h2>
                    <div class="des"><?= nl2br($service['description']) ?></div>
                    <button class="seeMore"><a href="<?= url('/inspiration?service=' . urlencode($service['valeur'])) ?>">Voir plus d'inspiration</a></button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="button">
        <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
        <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
    </div>
</section>