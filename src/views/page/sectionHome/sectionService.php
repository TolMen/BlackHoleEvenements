<!-- DESKTOP VERSION -->
<section class="container text-center boxService boxInteractive">
    <h2 class="section-title">Nos services</h2>
    <hr class="title-separator">
    <div class="boxGal">
        <div class="options">
            <?php foreach ($servicesForHome as $index => $service): ?>
                <div class="option <?= $index === 1 ? 'active' : '' ?>" style="--optionBackground: url(../../../public/assets/img/<?= $service['chemin_img'] ?>);">
                    <div class="label">
                        <div class="icon">
                            <img src="../../../public/assets/icon/<?= $service['chemin_icon'] ?>" alt="<?= $service['alt_icon'] ?>">
                        </div>
                        <div class="info">
                            <p class="title"><?= htmlspecialchars($service['nom']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- MOBILE VERSION -->
<section class="container text-center boxService boxSimpleGallery">
    <h2 class="section-title">Nos services</h2>
    <hr class="title-separator">
    <ul class="galleryResponsive">
        <?php foreach ($servicesForHome as $service): ?>
            <li>
                <div class="img-wrapper">
                    <img src="../../../public/assets/img/<?= $service['chemin_img'] ?>" alt="<?= $service['alt'] ?>">
                    <div class="label">
                        <div class="icon">
                            <img src="../../../public/assets/icon/<?= $service['chemin_icon'] ?>" alt="<?= $service['alt_icon'] ?>">
                        </div>
                        <div class="info">
                            <p class="title"><?= htmlspecialchars($service['nom']) ?></p>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>