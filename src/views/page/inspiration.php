<?php

/**
 * Galerie d'inspiration (/inspiration).
 *
 * Le filtre par service reste en paramètre d'URL (?service=…) : il s'agit
 * d'une variante de la même page, dont la version canonique est /inspiration.
 */

$pageTitle       = 'Inspiration : nos réalisations en images';
$pageDescription = 'Parcourez nos réalisations : décorations lumineuses, mises en lumière '
    . 'de châteaux et domaines, scènes de concert et ambiances de mariage en Auvergne.';
$pageCanonical   = absolute_url('/inspiration');
$pageStyles      = ['css/styleInspiration/styleInspiration.css'];

$pageJsonLd = jsonld_script([
    jsonld_organization(),
    jsonld_breadcrumb([
        'Accueil'     => '/',
        'Inspiration' => '/inspiration',
    ]),
]);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include VIEWS_PATH . '/component/head.php'; ?>
</head>

<body>

    <?php include VIEWS_PATH . '/component/navbar.php'; ?>

    <main>
        <?php include PAGES_PATH . '/sectionInspiration/sectionInspiration.php'; ?>
    </main>

    <?php include VIEWS_PATH . '/component/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts personnalisés — ORDRE IMPORTANT :
         galleryGestion.js doit être chargé EN PREMIER car il expose window.applyGalleryFilters
         utilisé par tous les autres scripts de filtrage. -->
    <script src="<?= asset('js/galleryGestion.js') ?>"></script>
    <script src="<?= asset('js/filterPhoto.js') ?>"></script>
    <script src="<?= asset('js/filterReset.js') ?>"></script>
    <script src="<?= asset('js/searchLieu.js') ?>"></script>
    <script src="<?= asset('js/filterServiceToInspiration.js') ?>"></script>

</body>

</html>
