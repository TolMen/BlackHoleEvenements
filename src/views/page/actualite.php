<?php

/**
 * Liste des actualités (/actualites).
 *
 * $articles et $articleImages sont préparés par ActualiteController::index().
 */

$pageTitle       = 'Actualités';
$pageDescription = 'Les dernières actualités de Black Hole Évènements : nouvelles '
    . 'prestations, coulisses de nos événements et retours sur nos réalisations.';
$pageCanonical   = absolute_url('/actualites');
$pageStyles      = ['css/styleActualite/styleListArt.css'];

// Liste des articles balisée en ItemList : Google comprend qu'il s'agit
// d'une page de rubrique et suit les liens vers chaque article.
$items = [];
$position = 1;

foreach ($articles as $article) {
    $items[] = [
        '@type'    => 'ListItem',
        'position' => $position++,
        'url'      => absolute_url(article_path((int) $article['id'], $article['title'])),
        'name'     => $article['title'],
    ];
}

$pageJsonLd = jsonld_script([
    jsonld_organization(),
    jsonld_breadcrumb(['Accueil' => '/', 'Actualités' => '/actualites']),
    [
        '@type'           => 'CollectionPage',
        '@id'             => absolute_url('/actualites') . '#collection',
        'name'            => 'Actualités de Black Hole Évènements',
        'mainEntity'      => [
            '@type'           => 'ItemList',
            'itemListElement' => $items,
        ],
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
        <?php include PAGES_PATH . '/sectionActualite/sectionListArt.php'; ?>
    </main>

    <?php include VIEWS_PATH . '/component/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>
