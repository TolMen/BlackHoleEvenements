<?php

/**
 * Page des prestations (/services).
 */

$pageTitle       = 'Nos prestations audiovisuelles et événementielles';
$pageDescription = 'Découvrez nos prestations : éclairage, sonorisation, vidéo projection, '
    . 'effets spéciaux, décoration lumineuse et simulation 3D pour mariages, concerts, '
    . 'festivals et salons professionnels.';
$pageCanonical   = absolute_url('/services');
$pageStyles      = ['css/styleService/styleService.css'];

$pageJsonLd = jsonld_script([
    jsonld_organization(),
    jsonld_breadcrumb([
        'Accueil'      => '/',
        'Prestations'  => '/services',
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
        <?php include PAGES_PATH . '/sectionService/sectionService.php'; ?>
    </main>

    <?php include VIEWS_PATH . '/component/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="<?= asset('js/slideService.js') ?>"></script>

</body>

</html>
