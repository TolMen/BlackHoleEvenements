<?php

/**
 * Page d'accueil (/).
 *
 * Les données ($servicesHome, $heroImages…) sont préparées par HomeController.
 */

$pageTitleRaw    = 'Black Hole Évènements | Prestataire audiovisuel et événementiel en Auvergne';
$pageDescription = 'Éclairage, sonorisation, vidéo projection et effets spéciaux pour vos '
    . 'mariages, concerts, festivals et salons à Riom, Clermont-Ferrand et partout en France.';
$pageCanonical   = absolute_url('/');
$pageStyles      = [
    'css/styleHome/styleGeneral.css',
    'css/styleHome/styleHero.css',
    'css/styleHome/styleVideo.css',
    'css/styleHome/styleService.css',
    'css/styleHome/styleAvis.css',
];

// Fiche entreprise + identité du site : les deux blocs que Google attend
// sur la page d'accueil pour rattacher le domaine à une entité connue.
$pageJsonLd = jsonld_script([
    jsonld_organization(),
    [
        '@type'     => 'WebSite',
        '@id'       => APP_URL . '/#website',
        'url'       => APP_URL . '/',
        'name'      => APP_NAME,
        'inLanguage' => 'fr-FR',
        'publisher' => ['@id' => APP_URL . '/#organization'],
    ],
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
        <?php include PAGES_PATH . '/sectionHome/sectionHero.php'; ?>
        <?php include PAGES_PATH . '/sectionHome/sectionService.php'; ?>
        <?php include PAGES_PATH . '/sectionHome/sectionVideo.php'; ?>
        <?php include PAGES_PATH . '/sectionHome/sectionAvis.php'; ?>
    </main>

    <?php include VIEWS_PATH . '/component/footer.php'; ?>

    <!-- Librairies JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts personnalisés -->
    <script src="<?= asset('js/autoPlayVideo.js') ?>"></script>
    <script src="<?= asset('js/serviceHoverActive.js') ?>"></script>
    <script src="<?= asset('js/countUp.js') ?>"></script>

</body>

</html>
