<section class="legal-section container py-5">
    <h2 class="section-title"><?= htmlspecialchars($pageTitle) ?></h2>
    <hr class="title-separator">

    <?php foreach ($data as $index => $item):
        $itemId = 'legal' . ($index + 1);
        $expanded = $index === 0 ? 'true' : 'false';
        $maxHeight = $index === 0 ? '1000px' : '0';
    ?>
        <div class="legal-item" tabindex="0" aria-expanded="<?= $expanded ?>" aria-controls="<?= $itemId ?>">
            <div class="legal-title">
                <span><?= htmlspecialchars($item[$fields[0]]) ?></span>
                <i class="legal-icon fa-solid fa-plus"></i>
            </div>
            <div id="<?= $itemId ?>" class="legal-content" style="max-height: <?= $maxHeight ?>;">
                <?= nl2br($item[$fields[1]]) ?>
            </div>
        </div>
    <?php endforeach; ?>
</section>