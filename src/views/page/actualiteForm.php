<?php

/**
 * Formulaire d'article, réservé à l'administration.
 *
 * $isUpdateView indique s'il s'agit d'une modification ($articleAncien,
 * $articleID, $imageUrl) ou d'une création.
 */

$pageTitle     = $isUpdateView ? 'Modifier un article' : 'Nouvel article';
$pageRobots    = 'noindex, nofollow';   // page d'administration : jamais indexée
$pageStyles    = ['css/styleActualite/styleArt.css'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include VIEWS_PATH . '/component/head.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
</head>

<body>

    <?php include VIEWS_PATH . '/component/navbar.php'; ?>

    <main>
        <?php if ($isUpdateView) {
            include PAGES_PATH . '/sectionActualite/sectionUpdateArt.php';
        } else {
            include PAGES_PATH . '/sectionActualite/sectionCreateArt.php';
        } ?>
    </main>

    <?php include VIEWS_PATH . '/component/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <?php include PUBLIC_PATH . '/js/scriptEditorQuill.php'; ?>

</body>

</html>
