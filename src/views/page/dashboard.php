<?php

/**
 * Espace d'administration (/admin, /admin/messagerie, /admin/galerie,
 * /admin/changelog).
 *
 * $adminView est fourni par AdminController ; les données de chaque écran
 * sont préparées par le contrôleur correspondant.
 */

$titres = [
    'dashboard'  => 'Tableau de bord',
    'messagerie' => 'Messagerie',
    'galerie'    => 'Galerie',
    'changelog'  => 'Journal des modifications',
];

$feuilles = [
    'dashboard'  => ['css/styleAdmin/styleDashboard.css'],
    'messagerie' => ['css/styleAdmin/styleMessagerie.css', 'css/stylePopUp/stylePopUp.css'],
    'galerie'    => ['css/styleAdmin/styleGallery.css'],
    'changelog'  => ['css/styleAdmin/styleChangelog.css'],
];

$pageTitle  = $titres[$adminView] ?? 'Administration';
$pageRobots = 'noindex, nofollow';   // espace privé : jamais indexé
$pageStyles = $feuilles[$adminView] ?? [];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include VIEWS_PATH . '/component/head.php'; ?>
</head>

<body>

    <?php include VIEWS_PATH . '/component/navbar.php'; ?>

    <main>
        <?php
        switch ($adminView) {
            case 'messagerie':
                include PAGES_PATH . '/sectionDashboard/sectionMessagerie.php';
                break;
            case 'galerie':
                include PAGES_PATH . '/sectionDashboard/sectionGallery.php';
                break;
            case 'changelog':
                include PAGES_PATH . '/sectionDashboard/sectionChangelog.php';
                break;
            default:
                include PAGES_PATH . '/sectionDashboard/sectionDashboard.php';
        }
        ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <?php if ($adminView === 'messagerie') { ?>
        <script src="<?= asset('js/messagePopup.js') ?>"></script>
    <?php } elseif ($adminView === 'dashboard') {
        include PUBLIC_PATH . '/js/historyVisit.php';
    } ?>

</body>

</html>
