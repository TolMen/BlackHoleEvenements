<?php
session_start();

// Modèle de gestion des articles
include_once '../../model/ActualiteModel/postArtModel.php';
$artPostModel = new PostArtModel();

// Détection du type de vue
$isCreateView = (isset($_GET['type']) && $_GET['type'] === 'create');
$isUpdateView = (isset($_GET['type']) && $_GET['type'] === 'update');
$isListView = false;

// Logique de routing
if ($isCreateView) {
    // Vue de création d’article
    $isListView = false;
} elseif (!empty($_GET['articleID'])) {
    // Vue de mise à jour ou consultation d’un article
    include_once '../../control/ActualiteControl/postArtControl.php';
    $isListView = false;
} else {
    // Vue liste des articles
    $articles = $artPostModel->getAllArt($bdd);
    $isListView = true;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Inclusion des balises meta -->
    <?php include '../component/head.php'; ?>

    <!-- Feuilles de style spécifiques -->
    <?php if ($isListView) { ?>
        <link rel="stylesheet" href="../../../public/css/styleActualite/styleListArt.css">
    <?php } else { ?>
        <link rel="stylesheet" href="../../../public/css/styleActualite/styleArt.css">
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <?php } ?>

    <title>Actualités - Black Hole Evènements</title>
</head>

<body>

    <!-- Inclusion de la barre de navigation -->
    <?php include '../component/navbar.php'; ?>

    <!-- Affichage des différentes sections -->
    <?php
    if ($isListView) {
        include 'sectionActualite/sectionListArt.php';
    } elseif ($isUpdateView) {
        $articleAncien = $article;
        $articleID = $article['id'];
        include 'sectionActualite/sectionUpdateArt.php';
    } elseif ($isCreateView) {
        include 'sectionActualite/sectionCreateArt.php';
    } else {
        include 'sectionActualite/sectionTemplateArt.php';
    }
    ?>

    <!-- Inclusion du pied de page -->
    <?php include '../component/footer.php'; ?>

    <!-- Librairies JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Script éditeur Quill -->
    <?php include '../../../public/js/scriptEditorQuill.php'; ?>

</body>

</html>
