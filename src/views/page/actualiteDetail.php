<?php

/**
 * Article d'actualité (/actualites/{id}-{slug}).
 *
 * $article, $imageUrl et $dateToShow sont préparés par ActualiteController::show().
 */

$articlePath   = article_path((int) $article['id'], $article['title']);

$pageTitle     = $article['title'];
$pageCanonical = absolute_url($articlePath);
$pageOgType    = 'article';
$pageOgImage   = absolute_asset(article_image_file($imageUrl));
$pageStyles    = ['css/styleActualite/styleArt.css'];

// Description : premières phrases de l'article, débarrassées du HTML.
$extrait = trim(preg_replace('/\s+/', ' ', strip_tags((string) $article['content'])) ?? '');

if ($extrait !== '') {
    $pageDescription = mb_substr($extrait, 0, 157) . (mb_strlen($extrait) > 157 ? '…' : '');
}

$publieLe  = date('c', strtotime((string) $article['created_at']));
$modifieLe = !empty($article['updated_at'])
    ? date('c', strtotime((string) $article['updated_at']))
    : $publieLe;

$pageJsonLd = jsonld_script([
    jsonld_organization(),
    jsonld_breadcrumb([
        'Accueil'          => '/',
        'Actualités'       => '/actualites',
        $article['title']  => $articlePath,
    ]),
    [
        '@type'            => 'Article',
        '@id'              => $pageCanonical . '#article',
        'headline'         => mb_substr((string) $article['title'], 0, 110),
        'description'      => $pageDescription ?? '',
        'image'            => $pageOgImage,
        'datePublished'    => $publieLe,
        'dateModified'     => $modifieLe,
        'inLanguage'       => 'fr-FR',
        'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => $pageCanonical],
        'author'           => ['@id' => APP_URL . '/#organization'],
        'publisher'        => ['@id' => APP_URL . '/#organization'],
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
        <?php include PAGES_PATH . '/sectionActualite/sectionTemplateArt.php'; ?>
    </main>

    <?php include VIEWS_PATH . '/component/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>
