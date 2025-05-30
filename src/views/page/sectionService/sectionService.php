<section class="boxService">
    <div class="slide">
        <?php foreach ($servicesForServicePage as $service): ?>
            <div class="item" style="background-image: url(../../../public/assets/img/<?= $service['chemin_img'] ?>);">
                <div class="content">
                    <div class="name"><?= htmlspecialchars($service['nom']) ?></div>
                    <div class="des"><?= nl2br($service['description']) ?></div>
                    <button class="seeMore">Voir plus d'inspiration</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="button">
        <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
        <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
    </div>
</section>
