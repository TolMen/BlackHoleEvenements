<?php

// Inclus les fichiers nécessaires
include_once __DIR__ . '/../../model/ActualiteModel/updateArtModel.php';
include_once __DIR__ . '/../../model/Services/imageService.php';

if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    header('Location: ' . url('/actualites'));

    // Fin du script après redirection volontaire pour éviter toute exécution supplémentaire
    exit;
}

// L'identifiant vient de la route /admin/actualites/{id} ; repli sur l'ancien paramètre.
$articleID = isset($articleID) ? (int) $articleID : intval($_GET['articleID'] ?? 0);
$title = $_POST['title'];
$content = $_POST['content'];

$imageName = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = PUBLIC_PATH . '/assets/img/imgActu/';

    $fileTmp = $_FILES['image']['tmp_name'];
    $fileOriginalName = basename($_FILES['image']['name']);
    $fileExtension = strtolower(pathinfo($fileOriginalName, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    $imageName = 'imgActu_' . $articleID . '.' . $fileExtension;
    $targetPath = $uploadDir . $imageName;

    if (ImageService::compressAndResizeImage($fileTmp, $targetPath, 800, 800, 75)) {
        $artModel = new UpdateArtModel();
        $artModel->updateImage($bdd, $articleID, $imageName);
    }
}

$artModel = new UpdateArtModel();
$artModel->updateArticle($bdd, $articleID, $title, $content);

header("Location: " . article_url($articleID, $title));

// Fin du script après redirection volontaire pour éviter toute exécution supplémentaire
exit;
